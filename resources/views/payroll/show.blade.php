<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payroll Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Nama Karyawan: {{ $payroll->employee->name }}</h5>
                <p class="card-text">Gaji Pokok: {{ $payroll->basic_salary }}</p>
                <p class="card-text">Tunjangan: {{ $payroll->allowances }}</p>
                <p class="card-text">Potongan: {{ $payroll->deductions }}</p>
                <p class="card-text">Gaji Bersih: {{ $payroll->net_salary }}</p>
                <p class="card-text">Tanggal Payroll: {{ $payroll->payroll_date }}</p>
                <a href="{{ route('payrolls.index') }}" class="btn btn-primary">Kembali</a>
                <a href="{{ route('payrolls.edit', $payroll->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('payrolls.destroy', $payroll->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>