@push('styles')
    <style>
        /* Hide original DataTables search box */
        .dataTables_filter {
            display: none !important;
        }

        .custom-search-box {
            position: relative;
            width: 300px;
        }

        .custom-search-box input {
            width: 100%;
            padding: 10px 50px 10px 20px;
            border-radius: 30px;
            border: 1px solid #ccc;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            outline: none;
            font-size: 14px;
            transition: 0.3s ease-in-out;
        }

        .custom-search-box input:focus {
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.2);
            border-color: #6c63ff;
        }

        .custom-search-box button {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 45px;
            border: none;
            background: #2196f3;
            color: white;
            border-top-right-radius: 30px;
            border-bottom-right-radius: 30px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .custom-search-box button:hover {
            background: #1976d2;
        }

        .custom-search-box i {
            font-size: 20px;
        }
    </style>
@endpush
