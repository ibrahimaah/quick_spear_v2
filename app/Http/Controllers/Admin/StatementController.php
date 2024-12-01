<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StatementController extends Controller
{
    public function remove_statement(Statement $statement)
    {
        try 
        {
            if ($statement->pdf_path && Storage::disk('public')->exists($statement->pdf_path)) 
            {
                // Check if the file exists in the storage
                $statementFilePath = storage_path('app/public/' . $statement->pdf_path);
                // Delete the file from storage
                unlink($statementFilePath);
            }

            // Delete the record from the database
            $statement->delete();

            // Return a response (you can customize this)
            return back()->with('success', 'تم الحذف بنجاح');
        }
        catch(Exception $ex)
        {
            dd($ex->getMessage());
        }
    }

}
