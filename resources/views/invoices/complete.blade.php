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
    <a href="{{url('invoice')}}" class="btn btn-default btn-md">Back (ត្រឡប់ក្រោយ)</a>
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
            {{$invoices->patient->first_name}} {{$invoices->patient->last_name}}<br>
            
            <strong>
                <span class="lang-en">Patient ID:</span>
                <span class="lang-km" style="display: none;">អត្តសញ្ញាណអ្នកជំងឺ:</span>
            </strong>
            {{$setting->patient_prefix}}{{$invoices->patient->id}}<br>
            
            @if(isset($invoices->report_id))
                <strong>
                    <span class="lang-en">Report No:</span>
                    <span class="lang-km" style="display: none;">លេខរបាយការណ៍:</span>
                </strong>
                {{$setting->invoice_prefix.$invoices->report_id}}<br>
            @endif
            
            <strong>
                <span class="lang-en">Age:</span>
                <span class="lang-km" style="display: none;">អាយុ:</span>
            </strong>
            {{$invoices->patient->age}}<br>
            
            <strong>
                <span class="lang-en">Sex:</span>
                <span class="lang-km" style="display: none;">ភេទ:</span>
            </strong>
            @if($invoices->patient->gender === 'Male' || $invoices->patient->gender === 'male')
                <span class="lang-en">Male</span>
                <span class="lang-km" style="display: none;">ប្រុស</span>
            @elseif($invoices->patient->gender === 'Female' || $invoices->patient->gender === 'female')
                <span class="lang-en">Female</span>
                <span class="lang-km" style="display: none;">ស្រី</span>
            @else
                {{$invoices->patient->gender}}
            @endif
            <br>
            
            <strong>
                <span class="lang-en">Payment:</span>
                <span class="lang-km" style="display: none;">ការទូទាត់:</span>
            </strong>
            @if($invoices->payment_type === 'Cash' || $invoices->payment_type === 'cash')
                <span class="lang-en">Cash</span>
                <span class="lang-km" style="display: none;">សាច់ប្រាក់</span>
            @elseif($invoices->payment_type === 'Cheque' || $invoices->payment_type === 'cheque')
                <span class="lang-en">Cheque</span>
                <span class="lang-km" style="display: none;">មូលប្បទានបត្រ</span>
            @elseif($invoices->payment_type === 'Credit' || $invoices->payment_type === 'credit')
                <span class="lang-en">Credit</span>
                <span class="lang-km" style="display: none;">ឥណទាន</span>
            @else
                {{$invoices->payment_type}}
            @endif
            <br>
        </div>
        
        <div class="col-xs-6" align="right" style="font-size: 1.05rem;">
            <strong>
                <span class="lang-en">Date:</span>
                <span class="lang-km" style="display: none;">កាលបរិច្ឆេទ:</span>
            </strong>
            {{$invoices->created_at}}<br>
            
            <strong>
                <span class="lang-en">Invoice#:</span>
                <span class="lang-km" style="display: none;">លេខវិក្កយបត្រ#:</span>
            </strong>
            {{$invoices->invoice_no}}
        </div>
        
        <div class="col-md-12" style="margin-top: 24px;">
            <table class="table">
                <thead>
                    <tr style="background-color: #f0fdf4; color: #047857;">
                        <th>
                            <span class="lang-en">S.N.</span>
                            <span class="lang-km" style="display: none;">ល.រ.</span>
                        </th>
                        <th>
                            <span class="lang-en">Particular</span>
                            <span class="lang-km" style="display: none;">សេវាកម្ម/ការពិពណ៌នា</span>
                        </th>
                        <th style="text-align: right;">
                            <span class="lang-en">Amount</span>
                            <span class="lang-km" style="display: none;">តម្លៃ</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @if($invoices->services)
                        @foreach($invoices->serviceSales()->get() as $sales)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$sales->service_name}}</td>
                                <td style="text-align: right;">{{format_price($sales->amount)}}</td>
                            </tr>
                        @endforeach
                    @elseif($invoices->opd)
                        @foreach($invoices->opd_sales()->get() as $sales)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$sales->opd_name}}</td>
                                <td style="text-align: right;">{{format_price($sales->opd_charge)}}</td>
                            </tr>
                        @endforeach
                    @else
                        @foreach($invoices->packageSales()->get() as $sales)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$sales->package->name}}</td>
                                <td style="text-align: right;">{{format_price($sales->package_price)}}</td>
                            </tr>
                        @endforeach
                    @endif
                    
                    <tr style="border-top: 2px solid #e5e7eb;">
                        <td></td>
                        <td style="text-align: right; font-weight: bold;">
                            <span class="lang-en">Sub Total:</span>
                            <span class="lang-km" style="display: none;">សរុបរង:</span>
                        </td>
                        <td style="text-align: right; font-weight: bold;">{{format_price($invoices->sub_total)}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="text-align: right; font-weight: bold;">
                            <span class="lang-en">Discount:</span>
                            <span class="lang-km" style="display: none;">បញ្ចុះតម្លៃ:</span>
                        </td>
                        <td style="text-align: right; font-weight: bold;">{{format_price($invoices->discount)}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="text-align: right; font-weight: bold;">
                            <span class="lang-en">HST({{$setting->tax_percent}}%):</span>
                            <span class="lang-km" style="display: none;">ពន្ធ({{$setting->tax_percent}}%):</span>
                        </td>
                        <td style="text-align: right; font-weight: bold;">{{format_price($invoices->tax_amount)}}</td>
                    </tr>
                    <tr class="success" style="background-color: #f0fdf4 !important; font-size: 1.15rem;">
                        <td></td>
                        <td style="text-align: right; font-weight: bold; color: #047857;">
                            <span class="lang-en">Total:</span>
                            <span class="lang-km" style="display: none;">សរុប:</span>
                        </td>
                        <td style="text-align: right; font-weight: bold; color: #047857;">{{format_price($invoices->total_amount)}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="col-xs-6" style="margin-top: 15px; font-size: 1.05rem;">
            <strong>
                <span class="lang-en">User:</span>
                <span class="lang-km" style="display: none;">អ្នកប្រើប្រាស់:</span>
            </strong>
            {{ $invoices->user->name}}<br>
            @if(isset($is_duplicate) && $is_duplicate)
                <span style="color: #dc2626; font-weight: bold;">
                    <span class="lang-en">DUPLICATE RECEIPT</span>
                    <span class="lang-km" style="display: none;">វិក្កយបត្រចម្លង</span>
                </span>
            @endif
        </div>
        
        <div class="col-xs-6" align="right" style="margin-top: 15px; font-size: 1.05rem;">
            <strong>
                <span class="lang-en">Cash:</span>
                <span class="lang-km" style="display: none;">សាច់ប្រាក់ទទួលបាន:</span>
            </strong>
            {{format_price($invoices->cash)}}<br>
            
            <strong style="color: #6b7280;">----------------------------</strong><br>
            
            <strong>
                <span class="lang-en">Return:</span>
                <span class="lang-km" style="display: none;">ប្រាក់អាប់:</span>
            </strong>
            {{format_price($invoices->return)}}<br>
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