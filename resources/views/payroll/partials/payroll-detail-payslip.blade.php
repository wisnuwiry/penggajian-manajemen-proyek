<section class="p-4 sm:p-8 bg-white shadow rounded-lg">
  <header>
    <h2 class="text-lg font-medium text-gray-900">
      {{ __('Payslips') }}
    </h2>
  </header>
  <hr class="mt-4">

  <div class="payslips flex flex-col mt-4 gap-4">
    @foreach ($payroll->details as $payslip)
    <div class="cursor-pointer p-4 border border-gray-300 rounded-md">
      <div class="flex justify-between">
        @php
        $formatter = new \NumberFormatter('id_ID', \NumberFormatter::CURRENCY);
        $totalFormated = $formatter->formatCurrency($payslip->take_home_pay, 'IDR');
        @endphp
        <div class="flex flex-col gap-4">
          <p class="font-bold text-lg">{{ $payslip->employee->first_name }} {{ $payslip->employee->last_name }}</p>
          <p>Take Home Pay: <span class="font-bold">{{ $totalFormated }}</span></p>
        </div>

        <div class="flex flex-row justify-end items-end gap-4">
          <x-detail-button data-payslip-id="{{ $payslip->id }}" onclick="viewPayslip(event, {{ $payslip->id }})" />
          <x-download-button href="{{ route('payslip.download', $payslip->id) }}" />
        </div>
      </div>
    </div>
    @endforeach
  </div>
</section>

<!-- Modal -->
<div id="payslipModal" class="fixed inset-0 flex items-center justify-center hidden">
  <div class="overlay fixed top-0 bottom-0 left-0 right-0 w-full h-full bg-black opacity-10" onclick="closeModal()"></div>
  <div class="bg-white rounded-lg shadow-lg w-3/4 max-w-4xl z-10">
    <div class="flex justify-end p-2">
      <div onclick="closeModal()" class="cursor-pointer">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 5.29295C5.68342 4.90243 6.31658 4.90243 6.70711 5.29295L12 10.5858L17.2929 5.29295C17.6834 4.90243 18.3166 4.90243 18.7071 5.29295C19.0976 5.68348 19.0976 6.31664 18.7071 6.70717L13.4142 12.0001L18.7071 17.293C19.0976 17.6835 19.0976 18.3166 18.7071 18.7072C18.3166 19.0977 17.6834 19.0977 17.2929 18.7072L12 13.4143L6.70711 18.7072C6.31658 19.0977 5.68342 19.0977 5.29289 18.7072C4.90237 18.3166 4.90237 17.6835 5.29289 17.293L10.5858 12.0001L5.29289 6.70717C4.90237 6.31664 4.90237 5.68348 5.29289 5.29295Z" fill="#6B7280" />
        </svg>
      </div>
    </div>
    <div class="p-4">
      <iframe id="payslipIframe" src="" width="100%" height="600px"></iframe>
    </div>
  </div>
</div>


<script>
  function viewPayslip(event, payslipId) {
    event.preventDefault();
    fetch(`/payroll/payslips/token/${payslipId}`)
      .then(response => response.json())
      .then(data => {
        const modal = document.getElementById('payslipModal');
        const iframe = document.getElementById('payslipIframe');
        iframe.src = `/payroll/payslips/view/${data.token}`;
        modal.classList.remove('hidden');
      })
      .catch(error => console.error('Error fetching payslip token:', error));
  }

  function closeModal() {
    const modal = document.getElementById('payslipModal');
    modal.classList.add('hidden');
    const iframe = document.getElementById('payslipIframe');
    iframe.src = '';
  }
</script>