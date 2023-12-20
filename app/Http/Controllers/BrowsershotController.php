<?php

namespace App\Http\Controllers;

use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;

class BrowsershotController extends Controller
{
    function screenshotGoogle()
    {
        Browsershot::url('http://delawi_accounting.test/invoicesreport?from=2022-06-20&to=2022-06-24')->savePdf('report1.pdf');

        // return redirect()->route('screenshotGoogle');
        return redirect(url('report1.pdf'));

        // return redirect()->route('screenshotGoogle');
        //    return url('report1.pdf');
        // redirect(url('report1.pdf'));
        // return view("report1.pdf");

    }

    function view()
    {
        return redirect(url('report1.pdf'));

    }


}
