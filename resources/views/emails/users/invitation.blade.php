@component('mail::message')
    You are invited by {{ $user->invitation_user }} from {{ $user->invitation_company }} to manage their shipment on
    Naov!
    <br>
    <br>
    Naov is a global supply chain management platform where supply chain companies can connect to their own freight
    forwarders to easily manage
    the movement of their goods around the world. Naov is focused in making mass shipping quick, easy, and accessible for
    everyone.
    Join {{ $user->invitation_company }} in this cause and together help us make a difference in the world.

@component('mail::button', ['url' => $user->url])
        {{ $user->button }}
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
