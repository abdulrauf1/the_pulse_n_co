@component('mail::message')
# New Contact Form Submission

**Name:** {{ $message->name }}  
**Email:** {{ $message->email }}  
@if($message->phone)**Phone:** {{ $message->phone }}@endif  
**Subject:** {{ $message->subject }}

**Message:**  
{{ $message->message }}

@component('mail::button', ['url' => 'mailto:'.$message->email])
Reply to {{ $message->name }}
@endcomponent

Thanks,  
{{ config('app.name') }}
@endcomponent