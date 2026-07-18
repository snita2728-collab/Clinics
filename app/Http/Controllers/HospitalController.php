<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\Tax;
use Config;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
    	$this->middleware('auth');
    }
    
    public function setting()
    {
    	$hospital = Hospital::find(1);
        //return $config;
    	return view('hospital.setting', compact('hospital'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateHospital(Request $request, $id)
    {
        $hospital = Hospital::find($id);
        $this->validate($request, [
            'name' => 'required',
            'slogan' => 'required',
            
            'address'=>'required',
            'contact'=>'required',
            'email'=>'required',
        ]);
        $data = $request->all();
        $hospital->update($data);
        return back()
            ->with('success', 'Hospital Setting updated successfully');
    }

    public function updateTax(Request $request, $id)
    {
        $tax = Tax::find($id);
        $this->validate($request, [
            'name' => 'required',
            'percent' => 'required',
        ]);
        $data = $request->all();
        $tax->update($data);
        return back()
            ->with('success', 'Tax Setting updated successfully');
    }

    public function updateConfig(Request $request)
    {
        $data = $request->all();
        //return $data['invoice_prefix'];
        Config::set('hms.prefix', $data);
            return back()
            ->with('success', 'Prefix changed updated successfully');
         
    }

    public function backup(Request $request)
    {
        if ($request->has('run')) {
            $db_name = env('DB_DATABASE', 'clinic');
            $db_user = env('DB_USERNAME', 'root');
            $db_password = env('DB_PASSWORD', 'admin');
            $db_host = env('DB_HOST', '127.0.0.1');
            $backup_path = public_path(date('Y-M-d-H-i-s').'.sql');

            $mysqldump = '"C:\\Program Files\\MySQL\\MySQL Server 8.0\\bin\\mysqldump.exe"';
            if (!file_exists("C:\\Program Files\\MySQL\\MySQL Server 8.0\\bin\\mysqldump.exe")) {
                $mysqldump = 'mysqldump';
            }
            $command = $mysqldump .' --opt -h' .$db_host .' -u' .$db_user .' -p' .$db_password .' ' .$db_name .' > "' .$backup_path . '"';

            $output = array();
            $worked = '';
            exec($command, $output , $worked);

            if ($worked === 0) {
                return redirect()->route('hospital.backup')->with('success', 'Database backed up successfully..');
            } else {
                return redirect()->route('hospital.backup')->withErrors('Backup cannot complete... please try again later.');
            }
        }

        // Get list of existing backups
        $files = glob(public_path('*.sql'));
        $backups = [];
        if ($files) {
            usort($files, function($a, $b) {
                return filemtime($b) - filemtime($a);
            });
            foreach ($files as $file) {
                $backups[] = [
                    'filename' => basename($file),
                    'size' => round(filesize($file) / 1024, 2) . ' KB',
                    'date' => date('Y-m-d H:i:s', filemtime($file)),
                    'download_url' => asset(basename($file))
                ];
            }
        }

        return view('hospital.backup', compact('backups'));
    }

    public function restore(Request $request)
    {
        $filename = $request->input('filename');
        if (empty($filename) || strpos($filename, '..') !== false || substr($filename, -4) !== '.sql') {
            return redirect()->route('hospital.backup')->withErrors('Invalid backup file.');
        }

        $backup_path = public_path($filename);

        if (!file_exists($backup_path)) {
            return redirect()->route('hospital.backup')->withErrors('Backup file does not exist.');
        }

        $db_name = env('DB_DATABASE', 'clinic');
        $db_user = env('DB_USERNAME', 'root');
        $db_password = env('DB_PASSWORD', 'admin');
        $db_host = env('DB_HOST', '127.0.0.1');

        $mysql = '"C:\\Program Files\\MySQL\\MySQL Server 8.0\\bin\\mysql.exe"';
        if (!file_exists("C:\\Program Files\\MySQL\\MySQL Server 8.0\\bin\\mysql.exe")) {
            $mysql = 'mysql';
        }

        $command = $mysql .' -h' .$db_host .' -u' .$db_user .' -p' .$db_password .' ' .$db_name .' < "' .$backup_path . '"';

        $output = array();
        $worked = '';
        exec($command, $output , $worked);

        if ($worked === 0) {
            return redirect()->route('hospital.backup')->with('success', 'Database restored successfully.');
        } else {
            return redirect()->route('hospital.backup')->withErrors('Restore failed. Please try again.');
        }
    }
        
}
