<x-app-layout>
    <div class="mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Question List</h4>
                <div class="mb-3">
                    <a class="btn btn-success" href="{{ route('admin.question.create') }}">Add Question</a>
                </div>
                @if(Session::has('success'))
                <p class="alert alert-success">{{ Session::get('success') }}</p>
                @endif
                @if(Session::has('error'))
                <p class="alert alert-danger">{{ Session::get('error') }}</p>
                @endif
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead class="text-uppercase bg-secondary">
                            <tr class="text-white">
                                <th scope="col">SN</th>
                                <th scope="col">Category</th>
                                <th scope="col">Question</th>
                                <th scope="col">Answer</th>
                                <th scope="col">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $key => $question)
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <td>{{ $question->category }}</td>
                                <td>{{ substr($question->question, strpos($question->question,'<p>')+3, 20) }}...</td>
                                <td>{{ substr($question->answer, strpos($question->answer,'<p>')+3, 20) }}...</td>
                                <td>
                                    <a
                                        href="{{ route('admin.question.edit', $question->id) }}"
                                        class="btn btn-sm btn-success mr-2"
                                        ><i class="ti-pencil"></i
                                    ></a>
                                    <form class="d-inline" action="{{ route('admin.question.destroy', $question->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to delete?')"
                                            ><i class="ti-trash"></i
                                        ></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
