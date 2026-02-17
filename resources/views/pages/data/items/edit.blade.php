<x-layout>
    <x-slot:title>Update | Items</x-slot:title>

    <div class="py-6">
        <div class="mx-auto max-w-7xl">

            <div class="rounded-xl bg-white shadow-sm border border-gray-200">
                <div class="border-b border-gray-100 p-6">
                    <h2 class="text-xl font-semibold text-gray-800">Edit Item</h2>
                    <p class="mt-1 text-sm text-gray-500">Silakan isi detail informasi di bawah ini untuk mengubah
                        item.</p>
                </div>

                <form action="{{ route('items.update', $item->id) }}" method="POST" class="p-8"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="space-y-8">
                        <div>
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div class="space-y-2">
                                    <label for="name" class="text-sm font-semibold text-gray-700">Nama Item</label>
                                    <div class="group relative my-2">
                                        <span
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 group-focus-within:text-teal-600 transition-colors">
                                            <i class="bx bx-purchase-tag text-lg"></i>
                                        </span>
                                        <input type="text" name="name" id="name" required
                                            class="block w-full rounded-xl border border-gray-300 bg-white py-2.5 pl-10 pr-3 text-gray-900 transition-all focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 outline-none"
                                            placeholder="Contoh: Kamera Sony A7III"
                                            value="{{ old('name', $item->name) }}" autocomplete="off">
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label for="category_id"
                                        class="text-sm font-semibold text-gray-700">Kategori</label>
                                    <div class="relative group my-2">
                                        <span
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 group-focus-within:text-teal-600 transition-colors">
                                            <i class="bx bx-category text-lg"></i>
                                        </span>
                                        <select name="category_id" id="category_id" required
                                            class="block w-full rounded-xl border border-gray-300 bg-white py-2.5 pl-10 pr-10 text-gray-900 transition-all focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 outline-none appearance-none">
                                            <option value="" disabled selected>Pilih kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <span
                                            class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                            <i class="bx bx-chevron-down text-xl"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center gap-2 mb-4 border-b border-gray-100 pb-2">
                                <i class="bx bx-coin-stack text-teal-600"></i>
                                <h3 class="font-semibold text-gray-800">Harga & Stok</h3>
                            </div>

                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div class="space-y-2">
                                    <label for="price_per_day" class="text-sm font-semibold text-gray-700">Harga Per
                                        Hari</label>
                                    <div class="relative group my-2">
                                        <span
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 font-semibold text-gray-500 group-focus-within:text-teal-600 transition-colors">
                                            Rp
                                        </span>
                                        <input type="number" name="price_per_day" id="price_per_day" required
                                            class="block w-full rounded-xl border border-gray-300 bg-white py-2.5 pl-10 pr-3 text-gray-900 transition-all focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 outline-none"
                                            placeholder="0" value="{{ old('price_per_day', $item->price_per_day) }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">

                            <div class="space-y-2" x-data="{ imagePreview: '{{ $item->image ? asset('image/items/' . $item->image) : null }}' }">
                                <div class="flex flex-col gap-4 my-2">
                                    <div class="flex items-center w-full">
                                        <label for="image"
                                            class="flex flex-col items-center justify-center w-full max-w-[340px] aspect-[4/5] border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gray-50 hover:bg-teal-50 hover:border-teal-400 transition-all overflow-hidden relative">

                                            <div x-show="!imagePreview"
                                                class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4">
                                                <i class="bx bx-cloud-upload text-4xl text-gray-400 mb-2"></i>
                                                <p class="text-xs text-gray-500 px-2">Klik untuk upload atau drag and
                                                    drop</p>
                                                <p class="text-[10px] text-gray-400 uppercase mt-2 font-bold">Rasio 4:5
                                                </p>
                                            </div>

                                            <template x-if="imagePreview">
                                                <div
                                                    class="absolute inset-0 w-full h-full flex items-center justify-center bg-gray-100">
                                                    <img :src="imagePreview" class="w-full h-full object-cover">
                                                    <div
                                                        class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                                                        <p
                                                            class="text-white text-xs font-bold bg-teal-600 px-3 py-1.5 rounded-lg">
                                                            Ganti Foto</p>
                                                    </div>
                                                </div>
                                            </template>

                                            <input type="file" name="image" id="image" accept="image/*"
                                                class="hidden"
                                                @change="
                                                    const file = $event.target.files[0];
                                                    if (file) {
                                                        const reader = new FileReader();
                                                        reader.onload = (e) => { imagePreview = e.target.result; };
                                                        reader.readAsDataURL(file);
                                                    }
                                                " />
                                        </label>
                                    </div>

                                    <template x-if="imagePreview">
                                        <button type="button"
                                            @click="imagePreview = null; document.getElementById('image').value = ''"
                                            class="text-xs font-semibold text-red-600 hover:text-red-700 flex items-center justify-start gap-1 ml-1">
                                            <i class="bx bx-trash"></i> Hapus Foto
                                        </button>
                                    </template>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="description" class="text-sm font-semibold text-gray-700">Deskripsi
                                    Item</label>
                                <textarea name="description" id="description"
                                    class="block w-full h-[320px] lg:h-[400px] rounded-xl border border-gray-300 bg-white p-4 my-2 text-gray-900 transition-all focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 outline-none resize-none"
                                    placeholder="Jelaskan kondisi barang, kelengkapan, dll..." autocomplete="off">{{ old('description', $item->description) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex items-center justify-end gap-3 border-t border-gray-100 pt-6">
                        <button type="button"
                            class="rounded-lg px-4 py-2.5 text-sm font-semibold text-gray-600 transition-colors hover:bg-gray-100">
                            <a href="{{ route('items.index') }}">Batal</a>
                        </button>
                        <button type="submit"
                            class="rounded-lg bg-teal-600 px-6 py-2.5 text-sm font-semibold text-white shadow-md transition-all hover:bg-teal-700 focus:ring-2 focus:ring-teal-500/40 active:scale-95">
                            Ubah Item
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
