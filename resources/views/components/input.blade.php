<div class="mx-2 mt-6 text-white form-group">
    <label class="block mb-1 text-sm font-thin text-red-500 xl:text-sm lg:text-xs" for={{ strtolower($label) }}>
        {{ $label }}
    </label>

    <input required value="{{ old($name) }}"
        class="w-full px-3 py-2 text-base leading-tight bg-transparent border-b-2 rounded shadow appearance-none focus:ring-opacity-0 text-gray-70 xl:py-2 lg:py-1 xl:text-base lg:text-xs focus:outline-none "
        id={{ strtolower($label) }} type={{ $type }} name={{ $name }} placeholder={{ $label }}>
</div>
