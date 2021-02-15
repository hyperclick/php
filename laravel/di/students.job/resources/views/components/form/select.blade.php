<div class="form-group">
    <label for="{{ $name }}">{{ $label }}:</label>
    <select name="{{ $name }}" id="{{ $name }}" {{ ($required ? 'required' : '') }}>
        @foreach($options as $value => $option)
            <option value="{{ $value }}" {{ isset($selected)? ($selected===$value ? "selected" : "") : "" }}>{{ $option }}</option>
        @endforeach
    </select>
</div>
