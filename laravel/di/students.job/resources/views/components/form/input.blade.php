<div class="form-group">
    <label for="{{ $name }}">{{ $label }}:</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}" {{ ($required ? 'required' : '') }}>
</div>
