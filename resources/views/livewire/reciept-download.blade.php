namespace App\Http\Livewire;

use Livewire\Component;
use barryvdh\DomPDF\Facade\Pdf;


class ReceiptDownload extends Component
{
    public $transactionId;

    public function mount($transactionId)
    {
        $this->transactionId = $transactionId;
    }

    public function downloadReceipt()
    {
        // Fetch transaction details from the database using the transaction ID
        $transaction = Transaction::find($this->transactionId);

        if (!$transaction) {
            session()->flash('error', 'Transaction not found.');
            return;
        }

        // Generate PDF using a Blade view
        $pdf = Pdf::loadView('receipts.transaction', ['transaction' => $transaction]);

        // Return the PDF as a download
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'receipt_' . $this->transactionId . '.pdf');
    }

    public function render()
    {
        return view('livewire.reciept-download');
    }
}
