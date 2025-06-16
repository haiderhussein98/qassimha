<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تفاصيل الفاتورة</title>
    <style>
        @font-face {
        font-family: 'Amiri';
        src: url("{{ public_path('fonts/Amiri-Regular.ttf') }}") format('truetype');
    }

    body {
        direction: rtl;
        text-align: right;
        font-family: 'Amiri', DejaVu Sans, sans-serif;
    
          
            font-size: 14px;
            margin: 0;
            padding: 20px;
            color: #000;
        }

        h2 {
            color: #0f5132;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #999;
            padding: 8px;
        }

        th {
            background-color: #d1e7dd;
            color: #0f5132;
        }
    </style>
</head>
<body>
    <h2>تفاصيل الفاتورة رقم {{ $expense->id }}</h2>

    <p><strong>التاريخ:</strong> {{ $expense->created_at->format('Y-m-d') }}</p>
    <p><strong>مجموع الفاتورة:</strong> {{ number_format($expense->total, 2) }} دينار</p>
    <p><strong>الحصة لكل شخص:</strong> {{ number_format($share, 2) }} دينار</p>

    <table>
        <thead>
            <tr>
                <th>الاسم</th>
                <th>دفع</th>
                <th>الفرق</th>
            </tr>
        </thead>
        <tbody>
            @foreach($names as $index => $name)
                @php
                    $paid = $amounts[$index];
                    $diff = $paid - $share;
                @endphp
                <tr>
                    <td>{{ $name }}</td>
                    <td>{{ number_format($paid, 2) }} د.ع</td>
                    <td>
                        @if($diff > 0)
                            له {{ number_format($diff, 2) }} د.ع
                        @elseif($diff < 0)
                            عليه {{ number_format(abs($diff), 2) }} د.ع
                        @else
                            متعادل
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
