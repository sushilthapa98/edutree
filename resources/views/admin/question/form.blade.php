<x-app-layout>
    <div class="mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Add Question</h4>
                <p class="text-muted font-14 mb-4">Enter Question and Answer in the form below on the basis of category.</p>
                @if(@$question)
                <form action="{{ route('admin.question.update', $question->id) }}" method="POST">
                @method('PUT')
                @else
                <form action="{{ route('admin.question.store') }}" method="POST">
                @endif
                    @csrf
                    <div class="form-group">
                        <label class="col-form-label">Question Category*</label>
                        <select name="category" class="form-control" required>
                            <option value="basic" {{ @$question->category == 'basic' ? 'selected' : '' }}>Basic</option>
                            <option value="intermediate" {{ @$question->category == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="advanced" {{ @$question->category == 'advanced' ? 'selected' : '' }}>Advanced</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Question*</label>
                        <textarea name="question" id="question" class="form-control" placeholder="Enter Question...">{{ @$question->question }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Answer</label>
                        <textarea name="answer" id="answer" class="form-control" placeholder="Enter Answer...">{{ @$question->answer }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Question</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
