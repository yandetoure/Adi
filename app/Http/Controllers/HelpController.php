<?php declare(strict_types=1); 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function index()
    {
        return view('help.index');
    }

    public function howToOrder()
    {
        return view('help.how-to-order');
    }

    public function trackOrder()
    {
        return view('help.track-order');
    }

    public function customerSupport()
    {
        return view('help.customer-support');
    }

    public function faq()
    {
        return view('help.faq');
    }

    public function shipping()
    {
        return view('help.shipping');
    }

    public function returns()
    {
        return view('help.returns');
    }

    public function paymentMethods()
    {
        return view('help.payment-methods');
    }

    public function privacy()
    {
        return view('help.privacy');
    }

    public function terms()
    {
        return view('help.terms');
    }
} 