<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category System') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- start alert message Add Success   --}}
            @if (session()->has('edit'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('edit') }}
                </div>
            @endif
            {{-- start alert message Error   --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- End   alert   message Error --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <h1 class="text-primary text-center text-md">Update Category</h1>
                        <form action="{{ url('categories/update') }}" method="post" >
                            {{ csrf_field() }}
                            <input type="hidden" name="category_id" id="id" value="{{ $category ->id }}">
                            <div class="mb-3">
                                <label for="exampleInputCat" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="exampleInputCat" name="category_name" value="{{$category->category_name}}">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
