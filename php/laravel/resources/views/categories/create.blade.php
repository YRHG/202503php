@extends('layouts.app')

@section('title', __('Add New Category'))

@section('content')
    <div class="max-w-2xl mx-auto px-6 py-10 bg-white/80 dark:bg-gray-800/60 backdrop-blur-md rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 tracking-tight">
                🚀 {{ __('Add New Category') }}
            </h1>
            <a href="{{ route('categories.index') }}"
               class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline transition">
                ← {{ __('Back to List') }}
            </a>
        </div>

        <form method="POST" action="{{ route('categories.store') }}" class="space-y-8">
            @csrf

            {{-- 分类名称 --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('Category Name') }} <span class="text-red-600">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                       class="w-full px-4 py-3 rounded-xl bg-white/70 dark:bg-gray-700/60 text-gray-900 dark:text-white shadow-sm placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-4 focus:ring-indigo-300 dark:focus:ring-indigo-600 @error('name') ring-2 ring-red-400 dark:ring-red-500 @enderror">
                @error('name')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- 操作按钮 --}}
            <div class="flex justify-end gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('categories.index') }}"
                   class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">
                    {{ __('Cancel') }}
                </a>
                <button type="submit"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white font-semibold text-sm rounded-xl shadow-lg hover:opacity-90 transition-all duration-200 focus:ring-4 focus:ring-pink-300 dark:focus:ring-pink-600">
                    💾 {{ __('Save Category') }}
                </button>
            </div>
        </form>
    </div>
@endsection

@push('styles')
    <style>
        /* 增强系统深色模式适配（macOS等） */
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #0f172a; /* slate-900 */
            }
        }
    </style>
@endpush
