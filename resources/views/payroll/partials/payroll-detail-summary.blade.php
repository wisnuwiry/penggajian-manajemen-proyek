<section class="p-4 sm:p-8 bg-white shadow rounded-lg">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Summary') }}
        </h2>
    </header>
    <hr class="mt-4">

    <div class="flex flex-row mt-4">
        <div class="flex flex-row flex-1 gap-6">
            <div class="flex flex-col">
                <p>ID</p>
                <p>Payroll Date</p>
                <p>Created Date</p>
            </div>
            <div class="flex flex-col flex-grow">
                <p class="font-bold">: {{ $payroll->formatted_id }}</p>
                <p class="font-bold">: {{ date('d M Y', strtotime($payroll->payroll_date)); }}</p>
                <p class="font-bold">: {{ date('d M Y', strtotime($payroll->created_at)); }}</p>
            </div>
        </div>
        <div class="flex flex-row flex-1 gap-6">
            <div class="flex flex-col">
                <p>Total Employee</p>
                <p>Total Take Home Pay</p>
            </div>
            <div class="flex flex-col flex-grow">
                <p class="font-bold">: {{ $payroll->details()->count() }}</p>
                @php
                $formatter = new \NumberFormatter('id_ID', \NumberFormatter::CURRENCY);
                $totalFormated = $formatter->formatCurrency($payroll->total_take_home_pay, 'IDR');
                @endphp
                <p class="font-bold">: {{ $totalFormated }}</p>
            </div>
        </div>
    </div>

    <form action="{{ route('payroll.destroy', $payroll) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="mt-4">
        @csrf
        @method('DELETE')
        <x-delete-button type="submit" />
    </form>
</section>