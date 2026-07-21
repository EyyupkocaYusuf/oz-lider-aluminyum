<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ], [
            'name.required' => 'Ad soyad zorunludur.',
            'phone.required' => 'Telefon zorunludur.',
            'email.required' => 'E-posta zorunludur.',
            'email.email' => 'Geçerli bir e-posta girin.',
            'message.required' => 'Mesaj zorunludur.',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->to('/#iletisim')
                ->withErrors($validator)
                ->withInput();
        }

        ContactMessage::create($validator->validated());

        return redirect()
            ->to('/#iletisim')
            ->with('success', 'Mesajınız alındı. En kısa sürede size dönüş yapacağız.');
    }
}
