<div class="mx-2 mt-6 form-group">
    <label class="block mb-1 text-sm font-thin text-red-500" for={{ strtolower($label) }}>
        {{ $label }}
    </label>
    <input class="w-full px-3 py-2 leading-tight text-gray-700 rounded shadow appearance-none focus:outline-none "
        id={{ strtolower($label) }} type={{ $type }} name={{ $name }} placeholder={{ $label }}>
</div>
