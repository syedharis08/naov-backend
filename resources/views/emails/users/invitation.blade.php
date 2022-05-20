@component('mail::message')
You are invited by {{ $user->invitation_user }} from {{ $user->company_name}} to manage their shipment on Naov!
<br>
<br>
Naov is a global supply chain community where users and their service providers come together to easily move
their goods around the world. Naov is focused in making mass shipping quick, easy, and accessible for everyone.
Join {{ $user->company_name }} in this cause and together help us make a difference in the world.

@component('mail::button', ['url' => $user->url])
{{ $user->button }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
