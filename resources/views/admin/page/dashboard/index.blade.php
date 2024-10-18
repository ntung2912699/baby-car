@extends('admin.layout_admin.main_layout')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        a {
            color: black !important;
            text-decoration: none !important;
        }
    </style>
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">{{ __('Quản Lý Tổng Quan') }}</h3>
            </div>
        </div>
        <div class="card card-stats card-round">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">{{ __('Phân tích báo cáo')  }}</div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <canvas id="visitorChart"></canvas>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                                    <i class="fas fa-user-check"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">{{ __('Xe Đã Bán') }}</p>
                                                    <h4 class="card-title">{{ $productSold }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                    <i class="fas fa-users"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">{{ __('Khách Hàng Đăng Ký') }}</p>
                                                    <h4 class="card-title">{{ $userCount }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                                    <i class="fas fa-luggage-cart"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">{{ __('Tổng Dòng Tiền') }}</p>
                                                    <h4 class="card-title">{{ $totalPrice }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <canvas id="revenueChart"></canvas>
                    </div>
                    <div class="col-md-6">
                        <canvas id="profitChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">{{ __('Khách Hàng Yêu Cầu Tư Vấn')  }}</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="multi-filter-select_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="multi-filter-select"
                                               class="display table dataTable" role="grid"
                                               aria-describedby="multi-filter-select_info">
                                            <thead>
                                            <tr role="row">
                                                <th style="min-width: 30px" aria-controls="multi-filter-select"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Name: activate to sort column descending"
                                                    aria-sort="ascending">
                                                    {{ trans('ID') }}
                                                </th>
                                                <th style="min-width: 130px" aria-controls="multi-filter-select"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                >
                                                    {{ trans('Tên') }}
                                                </th>
                                                <th style="min-width: 100px" aria-controls="multi-filter-select"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                >
                                                    {{ trans('Số Điện Thoại') }}
                                                </th>
                                                <th style="min-width: 100px" aria-controls="multi-filter-select"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                >
                                                    {{ trans('Loại Xe') }}
                                                </th>
                                                <th style="min-width: 100px" aria-controls="multi-filter-select"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                >
                                                    {{ trans('Trạng Thái') }}
                                                </th>
                                                <th style="min-width: 100px" aria-controls="multi-filter-select"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                >
                                                    {{ trans('Ghi Chú') }}
                                                </th>
                                                <th style="min-width: 120px" aria-controls="multi-filter-select"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Office: activate to sort column ascending"
                                                >{{ trans('Ngày Tạo') }}
                                                </th>
                                                <th style="min-width: 120px" aria-controls="multi-filter-select"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Age: activate to sort column ascending"
                                                >{{ trans('Ngày Sửa') }}
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach( $contactRequest as $contact)
                                                <tr role="row" class="odd">
                                                    <td class="text-start">{{ $contact->id }}</td>
                                                    <td class="text-start">{{ $contact->name }}</td>
                                                    <td class="text-start">{{ $contact->phone }}</td>
                                                    <td class="text-start">
                                                        <a href="{{ route('product-form.edit', ['id' => $contact->product->id ]) }}" type="button" data-bs-toggle="tooltip" title="">
                                                                {{ $contact->product->name }}
                                                        </a>
                                                    </td>
                                                    <td class="text-start">
                                                        <span class="status-text" id="status-text-{{ $contact->id }}">
                                                        @if($contact->status === $contactNew)
                                                                <span class="badge badge-danger">{{ $contact->status }}</span>
                                                            @else
                                                                <span class="badge badge-success">{{ $contact->status }}</span>
                                                            @endif
                                                        </span>
                                                        <button id="edit-status-button-{{ $contact->id }}" class="btn btn-link" onclick="editStatus({{ $contact->id }})">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <select id="status-select-{{ $contact->id }}" style="display:none;" onchange="updateStatus({{ $contact->id }})">
                                                            <option value="{{$contactNew}}" {{ $contact->status === $contactNew ? 'selected' : '' }}>{{ $contactNew }}</option>
                                                            <option value="{{ $contactOld }}" {{ $contact->status === $contactOld ? 'selected' : '' }}>{{ $contactOld }}</option>
                                                        </select>
                                                    </td>
                                                    <td class="text-start">
                                                        <span class="note-text" id="note-text-{{ $contact->id }}">{{ $contact->note }}</span>
                                                        <button id="edit-note-button-{{ $contact->id }}" class="btn btn-link" onclick="editNote({{ $contact->id }})">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <input type="text" id="note-input-{{ $contact->id }}" style="display:none;" value="{{ $contact->note }}" onblur="updateNote({{ $contact->id }})">
                                                    </td>
                                                    <td class="text-start">{{ $contact->created_at }}</td>
                                                    <td class="text-start">{{ $contact->updated_at }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">{{ __('Xe Mới Về')  }}</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="multi-filter-select_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="multi-filter-select"
                                               class="display table dataTable" role="grid"
                                               aria-describedby="multi-filter-select_info">
                                            <thead>
                                            <tr role="row">
                                                <th style="min-width: 30px" aria-controls="multi-filter-select"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Name: activate to sort column descending"
                                                    aria-sort="ascending">
                                                    {{ trans('ID') }}
                                                </th>
                                                <th style="min-width: 130px" aria-controls="multi-filter-select"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                >
                                                    {{ trans('Kiểu Dáng') }}
                                                </th>
                                                <th style="min-width: 100px" aria-controls="multi-filter-select"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                >
                                                    {{ trans('Hãng SX') }}
                                                </th>
                                                <th style="min-width: 100px" aria-controls="multi-filter-select"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                >
                                                    {{ trans('Dòng Xe') }}
                                                </th>
                                                <th style="min-width: 100px" aria-controls="multi-filter-select"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                >
                                                    {{ trans('Trạng Thái') }}
                                                </th>
                                                <th style="min-width: 250px" aria-controls="multi-filter-select"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                >
                                                    {{ trans('Tên') }}
                                                </th>
                                                <th aria-controls="multi-filter-select"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                >
                                                    {{ trans('Giá') }}
                                                </th>
                                                <th style="min-width: 120px" aria-controls="multi-filter-select"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Office: activate to sort column ascending"
                                                >{{ trans('Ngày Tạo') }}
                                                </th>
                                                <th style="min-width: 120px" aria-controls="multi-filter-select"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Age: activate to sort column ascending"
                                                >{{ trans('Ngày Sửa') }}
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach( $productNew as $product)
                                                <tr role="row" class="odd">
                                                    <td class="text-start">{{ $product->id }}</td>
                                                    <td class="text-start">{{ $product->category->name }}</td>
                                                    <td class="text-start">{{ $product->producer->name }}</td>
                                                    <td class="text-start">{{ $product->model->name }}</td>
                                                    <td class="text-start">
                                                        <span class="badge badge-info">
                                                            {{ $product->status->name }}
                                                        </span>
                                                    </td>
                                                    <td class="text-start">
                                                        <div class="avatar">
                                                            <img src="{{ asset($product->thumbnail) }}" alt="..." class="avatar-img rounded-circle">
                                                        </div>
                                                        <a  href="{{ route('product-form.edit', ['id' => $product->id ]) }}">
                                                            {{ $product->name }}
                                                        </a>
                                                    </td>
                                                    <td class="text-start">{{ $product->price }}</td>
                                                    <td class="text-start">{{ $product->created_at }}</td>
                                                    <td class="text-start">{{ $product->updated_at }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var ctx = document.getElementById('visitorChart').getContext('2d');
    var visitorChart = new Chart(ctx, {
        type: 'pie', // Chuyển sang biểu đồ tròn
        data: {
            labels: ['Lượt Tiếp Cận Hôm Nay', 'Lượt Tiếp Cận Tuần Này', 'Lượt Tiếp Cận Tháng Này'], // Nhãn cho các phần của biểu đồ
            datasets: [{
                label: 'Lượt khách truy cập',
                data: [{{ $visitorTodayCount }}, {{ $visitorWeekCount }}, {{ $visitorMonthCount }}], // Dữ liệu thực tế
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)', // Màu nền cho mỗi phần
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(75, 192, 192, 0.7)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)', // Màu viền cho mỗi phần
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1 // Độ rộng đường viền của biểu đồ
            }]
        },
        options: {
            responsive: true, // Tự động thay đổi kích thước biểu đồ khi kích thước màn hình thay đổi
            plugins: {
                legend: {
                    position: 'top', // Vị trí của chú giải (legend)
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            let value = tooltipItem.raw; // Giá trị thực tế
                            return ' ' + value + ' lượt'; // Hiển thị số lượt truy cập
                        }
                    }
                }
            }
        }
    });
</script>

<script>
    var ctx = document.getElementById('revenueChart').getContext('2d');
    var revenueChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Tuần Này', 'Tháng Này', 'Quý Này'],
            datasets: [{
                label: 'Doanh Thu (VNĐ)',
                data: [{{ $weeklyRevenue }}, {{ $monthlyRevenue }}, {{ $quarterlyRevenue }}],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value, index, values) {
                            return value.toLocaleString('vi-VN') + ' VNĐ'; // Format giá trị với VND
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.formattedValue + ' VNĐ'; // Thêm VND vào tooltip
                        }
                    }
                }
            }
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var ctx = document.getElementById('profitChart').getContext('2d');
    var revenueChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Tuần Này', 'Tháng Này', 'Quý Này'],
            datasets: [{
                label: 'Lợi Nhuận (VNĐ)',
                data: [{{ $weeklyProfit }}, {{ $monthlyProfit }}, {{ $quarterlyProfit }}],
                backgroundColor: [
                    'rgba(255, 159, 64, 0.7)', // Màu cam
                    'rgba(153, 102, 255, 0.7)', // Màu tím
                    'rgba(255, 99, 132, 0.7)'  // Màu đỏ
                ],
                borderColor: [
                    'rgba(255, 159, 64, 1)', // Màu cam
                    'rgba(153, 102, 255, 1)', // Màu tím
                    'rgba(255, 99, 132, 1)'  // Màu đỏ
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value, index, values) {
                            return value.toLocaleString('vi-VN') + ' VNĐ'; // Format giá trị với VND
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.formattedValue + ' VNĐ'; // Thêm VND vào tooltip
                        }
                    }
                }
            }
        }
    });
</script>
    <script>
        const accessToken = '{{ session('jwt_token') }}';
        let originalStatus; // Biến toàn cục để lưu giá trị trạng thái ban đầu
        let originalNote; // Biến toàn cục để lưu giá trị ghi chú ban đầu

        function editStatus(contactId) {
            const statusTextElement = document.getElementById(`status-text-${contactId}`);
            originalStatus = statusTextElement.innerText; // Lưu giá trị trạng thái ban đầu

            // Thay đổi nút từ "Edit" thành "X"
            const button = document.getElementById(`edit-status-button-${contactId}`);
            button.innerHTML = '<i class="fas fa-times"></i>'; // Thay đổi thành biểu tượng "X"
            button.setAttribute('onclick', `cancelEditStatus(${contactId})`); // Chuyển đổi hàm onclick

            // Ẩn trạng thái và hiển thị select
            statusTextElement.style.display = 'none';
            document.getElementById(`status-select-${contactId}`).style.display = 'block';
        }

        function cancelEditStatus(contactId) {
            const statusTextElement = document.getElementById(`status-text-${contactId}`);

            // Khôi phục trạng thái về giá trị ban đầu
            document.getElementById(`status-text-${contactId}`).innerHTML = `<span class="badge badge-${originalStatus === '{{ $contactNew }}' ? 'danger' : 'success'}">${originalStatus}</span>`;
            statusTextElement.style.display = 'block';
            document.getElementById(`status-select-${contactId}`).style.display = 'none';

            // Đổi nút về lại biểu tượng "Edit"
            const button = document.getElementById(`edit-status-button-${contactId}`);
            button.innerHTML = '<i class="fas fa-edit"></i>';
            button.setAttribute('onclick', `editStatus(${contactId})`);
        }

        function editNote(contactId) {
            const noteTextElement = document.getElementById(`note-text-${contactId}`);
            originalNote = noteTextElement.innerText; // Lưu giá trị ghi chú ban đầu

            // Thay đổi nút từ "Edit" thành "X"
            const button = document.getElementById(`edit-note-button-${contactId}`);
            button.innerHTML = '<i class="fas fa-times"></i>'; // Thay đổi thành biểu tượng "X"
            button.setAttribute('onclick', `cancelEditNote(${contactId})`); // Chuyển đổi hàm onclick

            noteTextElement.style.display = 'none';
            document.getElementById(`note-input-${contactId}`).style.display = 'block';
        }

        function cancelEditNote(contactId) {
            const noteTextElement = document.getElementById(`note-text-${contactId}`);

            // Khôi phục ghi chú về giá trị ban đầu
            noteTextElement.innerHTML = originalNote;
            noteTextElement.style.display = 'block';
            document.getElementById(`note-input-${contactId}`).style.display = 'none';

            // Đổi nút về lại biểu tượng "Edit"
            const button = document.getElementById(`edit-note-button-${contactId}`);
            button.innerHTML = '<i class="fas fa-edit"></i>';
            button.setAttribute('onclick', `editNote(${contactId})`);
        }

        function updateStatus(contactId) {
            const newStatus = document.getElementById(`status-select-${contactId}`).value;

            // Gửi AJAX để cập nhật trạng thái
            $.ajax({
                url: '{{ route('api.contact-update') }}',
                type: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + accessToken, // Set the JWT token in the Authorization header
                },
                cache: false,
                data: {
                    id: contactId,
                    status: newStatus,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Cập nhật giao diện người dùng với trạng thái mới
                    document.getElementById(`status-text-${contactId}`).innerHTML = `<span class="badge badge-${newStatus === '{{ $contactNew }}' ? 'danger' : 'success'}">${newStatus}</span>`;
                    document.getElementById(`status-text-${contactId}`).style.display = 'block';
                    document.getElementById(`status-select-${contactId}`).style.display = 'none';

                    Swal.fire({
                        icon: 'success',
                        title: 'Cập nhật thành công!',
                        text: 'Trạng thái đã được cập nhật.',
                        confirmButtonText: 'OK'
                    });

                    // Đổi nút về lại biểu tượng "Edit"
                    const button = document.getElementById(`edit-status-button-${contactId}`);
                    button.innerHTML = '<i class="fas fa-edit"></i>';
                    button.setAttribute('onclick', `editStatus(${contactId})`);
                },
                error: function(xhr) {
                    // Khôi phục trạng thái về giá trị ban đầu nếu có lỗi
                    document.getElementById(`status-text-${contactId}`).innerHTML = `<span class="badge badge-${originalStatus === '{{ $contactNew }}' ? 'danger' : 'success'}">${originalStatus}</span>`;
                    document.getElementById(`status-text-${contactId}`).style.display = 'block';
                    document.getElementById(`status-select-${contactId}`).style.display = 'none';

                    Swal.fire({
                        icon: 'error',
                        title: 'Đã xảy ra lỗi!',
                        text: xhr.responseJSON.message,
                        confirmButtonText: 'OK'
                    });
                }
            });
        }

        function updateNote(contactId) {
            const newNote = document.getElementById(`note-input-${contactId}`).value;

            // Gửi AJAX để cập nhật ghi chú
            $.ajax({
                url: '{{ route('api.contact-update') }}',
                type: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + accessToken, // Set the JWT token in the Authorization header
                },
                cache: false,
                data: {
                    id: contactId,
                    note: newNote,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    document.getElementById(`note-text-${contactId}`).innerHTML = newNote;
                    document.getElementById(`note-text-${contactId}`).style.display = 'block';
                    document.getElementById(`note-input-${contactId}`).style.display = 'none';

                    Swal.fire({
                        icon: 'success',
                        title: 'Cập nhật thành công!',
                        text: 'Ghi chú đã được cập nhật.',
                        confirmButtonText: 'OK'
                    });

                    // Đổi nút về lại biểu tượng "Edit"
                    const button = document.getElementById(`edit-note-button-${contactId}`);
                    button.innerHTML = '<i class="fas fa-edit"></i>';
                    button.setAttribute('onclick', `editNote(${contactId})`);
                },
                error: function(xhr) {
                    // Khôi phục ghi chú về giá trị ban đầu nếu có lỗi
                    document.getElementById(`note-text-${contactId}`).innerHTML = originalNote;
                    document.getElementById(`note-text-${contactId}`).style.display = 'block';
                    document.getElementById(`note-input-${contactId}`).style.display = 'none';

                    Swal.fire({
                        icon: 'error',
                        title: 'Đã xảy ra lỗi!',
                        text: xhr.responseJSON.message,
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    </script>
@stop
