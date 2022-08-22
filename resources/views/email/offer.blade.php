@component('mail::message')
# Discount Offer

20% Discount is going ON!

Click On the Below button
@component('mail::button', ['url' => "https://www.creativeitinstitute.com/", 'color' => 'success'])
Click me
@endcomponent

@component('mail::panel')
New Products Arrived daily.
@endcomponent

@component('mail::table')
| Laravel       | Table         | Example  |
| ------------- |:-------------:| --------:|
| Col 2 is      | Centered      | $10      |
| Col 3 is      | Right-Aligned | $20      |
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
