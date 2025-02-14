@props(['id', 'name', 'placeholder' => '', 'autocomplete' => '', 'withicon' => false])

<div class="relative" x-data="{ show: false }">
    <input 
        type="password" 
        id="{{ $id }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        autocomplete="{{ $autocomplete }}"
        x-ref="input"
        :type="show ? 'text' : 'password'"
        {{ $attributes->merge([
            'class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full' . ($withicon ? ' pl-11 pr-10' : ' pr-10')
        ]) }}
    />
    
    <button 
        type="button"
        @click="show = !show"
        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-600 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300"
    >
        <svg 
            x-show="!show"
            class="w-5 h-5" 
            fill="none" 
            stroke="currentColor" 
            viewBox="0 0 24 24"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        </svg>
        <svg 
            x-show="show"
            class="w-5 h-5" 
            fill="none" 
            stroke="currentColor" 
            viewBox="0 0 24 24"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
        </svg>
    </button>
</div> 