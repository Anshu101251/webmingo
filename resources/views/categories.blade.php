<!-- resources/views/categories/index.blade.php -->

@extends('dashboard')

@section('content')

    <div class="container">
        <h2>Categories and Subcategories</h2>

        <!-- Form to add a new category -->
        <form method="post" action="{{Route('create_category')}}">
            @csrf
            <div class="form-group">
                <label for="name">Category Name:</label>
                <input type="text" class="form-control" name="name">
                @error('name')
                    <div class="alert" style="color:red;padding:0px;font-size:10px">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create Category</button>
        </form>
        @if(session('category_success'))
            <div class="alert alert-success" id="error_msg">
                {{ session('category_success') }}
            </div>
        @endif
        <hr>
        

        <!-- Table to display categories and subcategories -->
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Subcategories</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{Route('sub_categories', ['id' => $category->id, 'name' => $category->name])}}" > SubCategory </a>
                        </td>
                        <td>                       
                        <a href="#" class="btn btn-success edit-btn" data-toggle="modal" data-target="#myModal" data-category-id="{{ $category->id }}" data-category-name="{{ $category->name }}">Edit</a>
                        </td>
                        <td>
                            <a href="{{ route('delete_category', ['id' => $category->id]) }}" class="btn btn-warning"> Delete </a> 
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Category</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form method="post" action="{{ route('update_category') }}" id="editCategoryForm">
                    @csrf
                    <div class="form-group">
                        <label for="edit_category_name">Category Name:</label>
                        <input type="text" class="form-control" name="name" id="edit_category_name" required>
                        <!-- @error('cat_name')
                            <div class="alert" style="color:red;padding:0px;font-size:10px">{{ $message }}</div>
                        @enderror    -->
                    </div>
                    <input type="hidden" name="id" id="edit_category_id">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

    </div>
<!-- Add these lines at the bottom of your HTML file, after jQuery and Popper.js -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>

    <script>
    $(document).ready(function () {
        $('.edit-btn').click(function () {
            var categoryId = $(this).data('category-id');
            var categoryName = $(this).data('category-name');

            $('#edit_category_id').val(categoryId);
            $('#edit_category_name').val(categoryName);

            //      var updateRoute = "{{ route('update_category', ['id' => ':categoryId']) }}";
            // updateRoute = updateRoute.replace(':categoryId', categoryId);
            // $('#editCategoryForm').attr('action', updateRoute);
        });
    });
</script>

@endsection
