<link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet" crossorigin="anonymous">
<style type="text/css">
	#print {
        margin: auto;
        width: 70%;
        border: 2px solid #10b981;
        border-radius: 12px;
        padding: 24px;
        background-color: #ffffff;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        font-family: 'Kantumruy Pro', sans-serif;
	}
    .printbtn {
        margin-bottom: 15px;
    }
    .btn-lang-active {
        background-color: #10b981 !important;
        color: #ffffff !important;
        border-color: #10b981 !important;
        font-weight: 600;
    }
    @media print {
        .printbtn, #printbtn, a {
            display: none !important;
        }
        #print {
            border: none !important;
            box-shadow: none !important;
            width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }
    }
</style>

<div class="text-center printbtn" style="margin: 20px 0;">
    <button onclick="setInvoiceLang('en')" class="btn btn-default btn-md" id="btn-lang-en">English Receipt</button>
    <button onclick="setInvoiceLang('km')" class="btn btn-default btn-md" id="btn-lang-km">វិក្កយបត្រភាសាខ្មែរ</button>
    <button onclick="window.print()" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-print"></span> Print (បោះពុម្ព)</button>
    <a href="{{url('invoice/report')}}" class="btn btn-default btn-md">Back (ត្រឡប់ក្រោយ)</a>
</div>

<div id="print">
	<div class="row">
        <div class="col-md-12" align="center" style="margin-bottom: 20px;">
            <h3 class="hospital-name-en" style="font-weight: 700; color: #047857; margin-bottom: 4px;">{{$setting->name}}</h3>
            <h3 class="hospital-name-km" style="font-weight: 700; color: #047857; margin-bottom: 4px; display: none;">អរុណរះ គ្លីនិក</h3>
            
            <strong class="lang-en" style="color: #4b5563;">{{$setting->address}}</strong>
            <strong class="lang-km" style="color: #4b5563; display: none;">ភូមិវាលយន្ត, សង្កាត់ស្វាយរៀង, ក្រុងស្វាយរៀង</strong>
            
            <address style="color: #4b5563; margin-top: 4px;">
                <span class="lang-en">Phone: {{$setting->contact}}</span>
                <span class="lang-km" style="display: none;">ទូរស័ព្ទ: {{$setting->contact}}</span>
            </address>
        </div>
        
        <div class="col-xs-6" style="font-size: 1.05rem;">
            <strong>
                <span class="lang-en">Patient:</span>
                <span class="lang-km" style="display: none;">អ្នកជំងឺ:</span>
            </strong>
            {{$invoice_return->invoice->patient->first_name}} {{$invoice_return->invoice->patient->last_name}}<br>
            
            <strong>
                <span class="lang-en">Patient ID:</span>
                <span class="lang-km" style="display: none;">អត្តសញ្ញាណអ្នកជំងឺ:</span>
            </strong>
            {{$setting->patient_prefix}}{{$invoice_return->invoice->patient->id}}<br>
            
            <strong>
                <span class="lang-en">Age:</span>
                <span class="lang-km" style="display: none;">អាយុ:</span>
            </strong>
            {{$invoice_return->invoice->patient->age}}<br>
            
            <strong>
                <span class="lang-en">Sex:</span>
                <span class="lang-km" style="display: none;">ភេទ:</span>
            </strong>
            @if($invoice_return->invoice->patient->gender === 'Male' || $invoice_return->invoice->patient->gender === 'male')
                <span class="lang-en">Male</span>
                <span class="lang-km" style="display: none;">ប្រុស</span>
            @elseif($invoice_return->invoice->patient->gender === 'Female' || $invoice_return->invoice->patient->gender === 'female')
                <span class="lang-en">Female</span>
                <span class="lang-km" style="display: none;">ស្រី</span>
            @else
                {{$invoice_return->invoice->patient->gender}}
            @endif
            <br>
            
            <strong>
                <span class="lang-en">Type:</span>
                <span class="lang-km" style="display: none;">ប្រភេទ:</span>
            </strong>
            <span class="lang-en" style="color: #dc2626; font-weight: bold;">Return Invoice</span>
            <span class="lang-km" style="display: none; color: #dc2626; font-weight: bold;">វិក្កយបត្រត្រឡប់មកវិញ</span>
            <br>
        </div>
        
        <div class="col-xs-6" align="right" style="font-size: 1.05rem;">
            <strong>
                <span class="lang-en">Date:</span>
                <span class="lang-km" style="display: none;">កាលបរិច្ឆេទ:</span>
            </strong>
            {{$invoice_return->created_at}}<br>
            
            <strong>
                <span class="lang-en">Invoice#:</span>
                <span class="lang-km" style="display: none;">លេខវិក្កយបត្រ#:</span>
            </strong>
            {{$invoice_return->invoice->invoice_no}}<br>
            
            <strong>
                <span class="lang-en">Return#:</span>
                <span class="lang-km" style="display: none;">លេខត្រឡប់#:</span>
            </strong>
            {{$invoice_return->id}}
        </div>
        
        <div class="col-md-12" style="margin-top: 24px;">
            <table class="table">
                <thead>
                    <tr style="background-color: #fef2f2; color: #991b1b;">
                        <th>
                            <span class="lang-en">S.N.</span>
                            <span class="lang-km" style="display: none;">ល.រ.</span>
                        </th>
                        <th>
                            <span class="lang-en">Invoice No.</span>
                            <span class="lang-km" style="display: none;">លេខវិក្កយបត្រ</span>
                        </th>
                        <th>
                            <span class="lang-en">Return Amount</span>
                            <span class="lang-km" style="display: none;">ទឹកប្រាក់ត្រឡប់</span>
                        </th>
                        <th>
                            <span class="lang-en">Reason</span>
                            <span class="lang-km" style="display: none;">មូលហេតុ</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$invoice_return->invoice->invoice_no}}</td>
                        <td style="color: #dc2626; font-weight: bold;">{{format_price($invoice_return->return_amount)}}</td>
                        <td>{{$invoice_return->return_reason}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="col-xs-6" style="margin-top: 15px; font-size: 1.05rem;">
            <strong>
                <span class="lang-en">User:</span>
                <span class="lang-km" style="display: none;">អ្នកប្រើប្រាស់:</span>
            </strong>
            {{ $invoice_return->user->username}}<br>
            <small style="color: #6b7280;">{{date('Y-m-d')}}</small>
        </div>
        
        <div class="col-md-12 text-center" style="margin-top: 30px; border-top: 1px dashed #d1d5db; padding-top: 15px; color: #6b7280; font-size: 0.95rem;">
            {{$setting->invoice_message}}
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>
<script>
function setInvoiceLang(lang) {
    if (lang === 'km') {
        $('.lang-en').hide();
        $('.lang-km').show();
        $('.hospital-name-en').hide();
        $('.hospital-name-km').show();
        $('#btn-lang-km').addClass('btn-lang-active').removeClass('btn-default');
        $('#btn-lang-en').addClass('btn-default').removeClass('btn-lang-active');
    } else {
        $('.lang-km').hide();
        $('.lang-en').show();
        $('.hospital-name-km').hide();
        $('.hospital-name-en').show();
        $('#btn-lang-en').addClass('btn-lang-active').removeClass('btn-default');
        $('#btn-lang-km').addClass('btn-default').removeClass('btn-lang-active');
    }
}

// Initialize with current locale
$(document).ready(function() {
    var currentLocale = "{{ App::getLocale() }}";
    setInvoiceLang(currentLocale === 'km' ? 'km' : 'en');
});
</script>