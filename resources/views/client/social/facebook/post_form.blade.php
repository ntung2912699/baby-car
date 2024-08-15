@extends('admin.layout_admin.main_layout')

@section('content')
    <style>
        .post-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 20px;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        .post-container h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .post-container .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 16px;
        }

        .post-container .alert.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .post-container .alert.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .post-container form {
            display: flex;
            flex-direction: column;
        }

        .post-container .product-list {
            margin-bottom: 20px;
        }

        .post-container .product-list div {
            display: flex;
            align-items: center;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
            transition: background-color 0.3s;
            position: relative;
        }

        .post-container .product-list div:hover {
            background-color: #e4e6eb;
        }

        .post-container .product-list input[type="checkbox"] {
            margin-right: 10px;
        }

        .post-container .product-list label {
            font-size: 16px;
            color: #333;
            flex-grow: 1;
        }

        .post-container .product-list .thumbnail {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-left: 10px;
        }

        .post-container button {
            background-color: #1877f2;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
            margin-top: 10px;
        }

        .post-container button:hover {
            background-color: #165c9d;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-image {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 8px;
        }

        #productDetailModal {
            z-index: 10;
            padding-top: 0px;
        }
    </style>

    <div class="page-header">
        <h3 class="fw-bold mb-3">Đăng Tin Bán Xe</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('admin.index') }}">
                    <i class="fas fa-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="fas fa-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{ trans('Marketing') }}</a>
            </li>
            <li class="separator">
                <i class="fas fa-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Đăng Tin Bán Xe</a>
            </li>
        </ul>
    </div>

    <div class="post-container">
        <h2>Chọn Sản Phẩm để Đăng</h2>
        @if (session('status'))
            <div class="alert alert-info">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('facebook.post-publish') }}" method="POST">
            @csrf
            <div class="product-list">
                @foreach($productList as $product)
                    <div>
                        <input type="checkbox" name="products[]" value="{{ $product->id }}" id="product-{{ $product->id }}">
                        <label class="product-name" data-product-id="{{ $product->id }}">{{ $product->name }}</label>
                        <img src="{{ $product->thumbnail }}" alt="Thumbnail" class="thumbnail">
                    </div>
                @endforeach
            </div>
            <div class="col-sm-12 col-md-12">
                {{ $productList->links('admin.vendor.pagination.custom_pagination') }}
            </div>
            <button type="submit">AI Tạo & Đăng Bài Lên Facebook</button>
        </form>
    </div>

    <!-- Modal -->
    <div id="productDetailModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="productName"></h2>
            <img id="productImage" src="" alt="Product Image" class="modal-image">
            <p id="productDescription"></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById("productDetailModal");
            var span = document.getElementsByClassName("close")[0];

            document.querySelectorAll('.product-name').forEach(function(element) {
                element.addEventListener('click', function() {
                    var productId = this.getAttribute('data-product-id');

                    // Fetch product details via AJAX or set them manually if available
                    fetch('facebook-products/' + productId) // Assuming you have a route to get product details
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('productName').innerText = data.name;
                            document.getElementById('productImage').src = data.thumbnail;
                            document.getElementById('productDescription').innerText = data.description;
                            modal.style.display = "block";
                        });
                });
            });

            span.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        });
    </script>
@stop
