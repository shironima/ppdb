<form action="{{ $action }}" method="POST">
    @csrf
    @method('PUT')
    <select name="status" class="form-control mb-3">
        @foreach($statusOptions as $value => $label)
            <option value="{{ $value }}" {{ $currentStatus == $value ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary btn-sm">Update Status</button>
</form>
