<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LoanDetail;
use Illuminate\Support\Facades\DB;

class LoanDetailsController extends Controller
{
    public function index()
    {
        $loanDetails = LoanDetail::all(); 
        DB::statement('DROP TABLE IF EXISTS emi_details');
        return view('loan-details.index', compact('loanDetails'));
    }

    public function processData()
    {
        if (\Schema::hasTable('emi_details')) {
            $emiDetails = DB::table('emi_details')->get();
        } else {
            $emiDetails = [];
        }
        if(!empty($emiDetails)) $firstTimeProcessData = 1;
        else $firstTimeProcessData = 0;
        return view('loan-details.processdata',compact('firstTimeProcessData','emiDetails'));
    }

    public function processDataFunc(Request $request)
    {
        // Fetch the min first_payment_date and max last_payment_date
        $dateRange = DB::selectOne('
            SELECT MIN(first_payment_date) as min_date, MAX(last_payment_date) as max_date 
            FROM loan_details
        ');

        if (!$dateRange->min_date || !$dateRange->max_date) {
            return redirect()->back()->with('error', 'No data available to process.');
        }

        $minDate = new \DateTime($dateRange->min_date);
        $maxDate = new \DateTime($dateRange->max_date);

        // Generate the list of columns for each month
        $columns = [];
        while ($minDate <= $maxDate) {
            $columns[] = $minDate->format('Y_M');
            $minDate->modify('+1 month');
        }

        // Drop the table if it exists
        DB::statement('DROP TABLE IF EXISTS emi_details');

        // Create the emi_details table with dynamic columns
        $columnsSql = implode(' INT, ', $columns) . ' INT';
        $createTableSql = "
            CREATE TABLE emi_details (
                clientid INT PRIMARY KEY,
                $columnsSql
            )
        ";

        DB::statement($createTableSql);


        // Fetch all loan details
        $loans = DB::select('SELECT clientid, num_of_payment, first_payment_date, last_payment_date, loan_amount FROM loan_details');

        // Prepare and insert EMI details for each loan
        foreach ($loans as $loan) {
            $emiAmount = $loan->loan_amount / $loan->num_of_payment;

            $startDate = new \DateTime($loan->first_payment_date);
            $endDate = new \DateTime($loan->last_payment_date);

            $emiDetails = array_fill_keys($columns, 0.00);
            $currentDate = clone $startDate;

            for ($i = 0; $i < $loan->num_of_payment; $i++) {
                $monthColumn = $currentDate->format('Y_M');
                $emiDetails[$monthColumn] = round($emiAmount, 2);
                $currentDate->modify('+1 month');
            }

            $lastMonthColumn = $endDate->format('Y_M');
            $totalEMI = array_sum($emiDetails);
            $adjustment = round($loan->loan_amount - $totalEMI, 2);
            $emiDetails[$lastMonthColumn] += $adjustment;

            // Insert the EMI details into the emi_details table
            $insertData = array_merge(['clientid' => $loan->clientid], $emiDetails);
            DB::table('emi_details')->insert($insertData);
        }

        $emiDetails = DB::table('emi_details')->get();
        $firstTimeProcessData = 1;
        return redirect()->back()->with('success', 'EMI details table created successfully.')->with('emiDetails',$emiDetails)->with('firstTimeProcessData',1);
    }
}
