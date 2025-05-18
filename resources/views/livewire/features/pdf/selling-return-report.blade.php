@extends('livewire.features.pdf.report')

@section('content')
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr>
            <td style="width: 50%">
                <span style="width: 100%; text-align: center; font-weight: bold; font-size: 14px;"
                      class="text-dark">{{ $title }}</span>
            </td>
            <td style="width: 50%; text-align: right">
                <span style="font-style: italic" class="font-normal text-light">Period ({{ $period }})</span>
            </td>
        </tr>
    </table>

    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td
                style="border: 1px solid #0f172a; width: 15%; text-align: center; vertical-align: middle;"
                class="tb-px tb-py"
            >
                <span class="font-normal text-dark font-bold leading-0">Date</span>
            </td>
            <td
                style="border: 1px solid #0f172a; width: 18%; text-align: center; vertical-align: middle;"
                class="tb-px tb-py"
            >
                <span class="font-normal text-dark font-bold leading-0">Invoice ID</span>
            </td>
            <td
                style="border: 1px solid #0f172a; vertical-align: middle;"
                class="tb-px tb-py"
            >
                <span class="font-normal text-dark font-bold leading-0">Customer</span>
            </td>
            <td
                style="border: 1px solid #0f172a; width: 15%; text-align: right; vertical-align: middle;"
                class="tb-px tb-py"
            >
                <span class="font-normal text-dark font-bold leading-0">Total</span>
            </td>
        </tr>
        @foreach($data as $datum)
            <tr>
                <td
                    style="border: 1px solid #0f172a; width: 15%; max-width: 15%; text-align: center; vertical-align: middle;"
                    class="tb-px tb-py"
                >
                    <span
                        class="font-normal text-light leading-0">{{ \Carbon\Carbon::parse($datum->date)->format('d/m/Y') }}</span>
                </td>
                <td
                    style="border: 1px solid #0f172a; width: 22%; text-align: center; vertical-align: middle;"
                    class="tb-px tb-py"
                >
                    <span class="font-normal text-light leading-0">{{ $datum->reference_number }}</span>
                </td>
                <td
                    style="border: 1px solid #0f172a; vertical-align: middle; word-wrap: break-word; white-space: normal;"
                    class="tb-px tb-py"
                >
                    <span
                        class="font-normal text-light leading-0">{{ $datum->customer ? $datum->customer->name : '-' }}</span>
                </td>
                <td
                    style="border: 1px solid #0f172a; width: 15%; text-align: right; vertical-align: middle;"
                    class="tb-px tb-py"
                >
                    <span
                        class="font-normal text-light font-bold leading-0">{{ number_format($datum->total, 0, ",", ".") }}</span>
                </td>
            </tr>
            <tr>
                <td class="tb-px tb-py" colspan="3" style="border-left: 1px solid #0f172a;">
                    <table style="width: 100%; border-collapse: collapse">
                        <tr>
                            <td style="width: 50%;">
                                <span class="font-small font-bold text-dark leading-0">Cart List</span>
                            </td>
                            <td style="width: 50%; text-align: right;">
                                {{--                                <span--}}
                                {{--                                    class="font-small font-bold text-light leading-0"--}}
                                {{--                                    style="font-style: italic; text-align: right"--}}
                                {{--                                >--}}
                                {{--                                    Purchased By :--}}
                                {{--                                    @if($datum->user->sales)--}}
                                {{--                                        <span style="margin-left: 5px;">{{ $datum->user->sales->name }}</span>--}}
                                {{--                                    @else--}}
                                {{--                                        <span style="margin-left: 5px;">Cashier</span>--}}
                                {{--                                    @endif--}}
                                {{--                                </span>--}}
                            </td>
                        </tr>
                    </table>

                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                        <tr>
                            <td
                                style="border-bottom: 1px solid #0f172a; vertical-align: middle;"
                                class="tb-px tb-py"
                            >
                                <span class="font-small text-dark font-bold leading-0">Product</span>
                            </td>
                            <td
                                style="border-bottom: 1px solid #0f172a; width: 12%; text-align: center; vertical-align: middle;"
                                class="tb-px tb-py"
                            >
                                <span class="font-small text-dark font-bold leading-0">Qty</span>
                            </td>
                            <td
                                style="border-bottom: 1px solid #0f172a; width: 12%; text-align: center; vertical-align: middle;"
                                class="tb-px tb-py"
                            >
                                <span class="font-small text-dark font-bold leading-0">Unit</span>
                            </td>
                            <td
                                style="border-bottom: 1px solid #0f172a; width: 15%; text-align: right; vertical-align: middle;"
                                class="tb-px tb-py"
                            >
                                <span class="font-small text-dark font-bold leading-0">Price</span>
                            </td>
                            <td
                                style="border-bottom: 1px solid #0f172a; width: 15%; text-align: right; vertical-align: middle;"
                                class="tb-px tb-py"
                            >
                                <span class="font-small text-dark font-bold leading-0">Total</span>
                            </td>
                        </tr>
                        @foreach($datum->details as $cart)
                            <tr>
                                <td
                                    style="border-bottom: 1px solid #0f172a; vertical-align: middle;"
                                    class="tb-px tb-py"
                                >
                                    <span class="font-small text-dark leading-0">{{ $cart->item->name }}</span>
                                </td>
                                <td
                                    style="border-bottom: 1px solid #0f172a; width: 12%; text-align: center; vertical-align: middle;"
                                    class="tb-px tb-py"
                                >
                                    <span class="font-small text-dark leading-0">{{ $cart->qty }}</span>
                                </td>
                                <td
                                    style="border-bottom: 1px solid #0f172a; width: 12%; text-align: center; vertical-align: middle;"
                                    class="tb-px tb-py"
                                >
                                    <span class="font-small text-dark leading-0">{{ ucfirst($cart->unit) }}</span>
                                </td>
                                <td
                                    style="border-bottom: 1px solid #0f172a; width: 15%; text-align: right; vertical-align: middle;"
                                    class="tb-px tb-py"
                                >
                                    <span
                                        class="font-small text-dark leading-0">{{ number_format($cart->price, 0, ",", ".") }}</span>
                                </td>
                                <td
                                    style="border-bottom: 1px solid #0f172a; width: 15%; text-align: right; vertical-align: middle;"
                                    class="tb-px tb-py"
                                >
                                    <span
                                        class="font-small text-dark font-bold leading-0">{{ number_format($cart->total, 0, ",", ".") }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </td>
                <td style="width: 15%; border-right: 1px solid #0f172a;"></td>
            </tr>
        @endforeach
        <tr>
            <td
                colspan="3"
                style="border: 1px solid #0f172a; text-align: right; vertical-align: middle;"
                class="tb-px tb-py"
            >
                <span
                    class="font-normal text-light font-bold leading-0">Total Selling Return :</span>
            </td>
            <td
                style="width: 15%; border: 1px solid #0f172a; text-align: right; vertical-align: middle;"
                class="tb-px tb-py"
            >
                <span
                    class="font-normal text-light font-bold leading-0">{{ number_format($data->sum('total'), 0, ",", ".") }}</span>
            </td>
        </tr>
    </table>
@endsection
