<x-mail::message>
    # Il progetto "{{ $project->name }}" è stato pubblicato correttamente

    {{-- Your order has been shipped!

    <x-mail::button url="">
        View Order
    </x-mail::button> --}}

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>

{{-- <h1> </h1> --}}
