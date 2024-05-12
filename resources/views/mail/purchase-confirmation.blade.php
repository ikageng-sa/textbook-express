<x-mail::message>
# Purchase Confirmation

Your purchase was successful, here's your details:

    - Name: {{ $purchase->name }}

    -----------------------------------------
    Billing Address:
    -----------------------------------------
        - Address: {{ $purchase->address }}
        - Zip Code: {{ $purchase->postal_code }}

    -----------------------------------------


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
