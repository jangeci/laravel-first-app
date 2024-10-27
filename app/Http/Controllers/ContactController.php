<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactForm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;

class ContactController extends Controller
{

    public function Index()
    {
        $contact = DB::table('contacts')->first();
        return view('screens.contact', compact(['contact']));
    }

    public function AdminContact()
    {
        $contacts = Contact::all();
        return view('admin.contact.index', compact('contacts'));
    }

    public function AddContact()
    {
        return view('admin.contact.create');
    }

    public function StoreContact(Request $request)
    {
        validator($request->all(), [
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        Contact::insert([
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        return Redirect()->route('admin.contact')->with('success', 'Contact created successfully');
    }

    public function EditContact($id)
    {
        $contact = Contact::find($id)->first();
        return view('admin.contact.edit', compact('contact'));
    }

    public function UpdateContact(Request $request, $id)
    {
        validator($request->all(), [
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        Contact::find($id)->update([
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        return Redirect()->route('admin.contact')->with('success', 'Contact Updated Successfully');
    }

    public function DeleteContact($id)
    {
        Contact::find($id)->delete();
        return Redirect()->route('admin.contact')->with('success', 'Contact Deleted Successfully');
    }


    public function ContactFormMessage(Request $request)
    {
        validator($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        ContactForm::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->route('contact')->with('success', 'Message Sent');
    }


    public function Messages()
    {
        $messages = ContactForm::latest()->paginate(5);

        return view('admin.contact.messages', compact('messages'));
    }

    public function DeleteMessage($id)
    {
        ContactForm::destroy($id);
        return Redirect()->back()->with('success', 'Message Deleted Successfully');
    }
}
