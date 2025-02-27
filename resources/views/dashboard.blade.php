<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Welcome Message -->
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-6">
                <p class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </p>
            </div>

            <!-- Public Posts Link -->
            <div class="mb-6 text-center">
                <a href="{{ route('posts.index') }}" class="text-blue-600 font-semibold hover:underline">
                    View Public Posts
                </a>
            </div>

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Preview Section -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Preview</h3>

                    <!-- Live Text Preview -->
                    <div class="p-4 border rounded-lg min-h-[100px] bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-gray-300"
                         id="textPreview">
                        Your text will appear here...
                    </div>

                    <!-- Image Preview -->
                    <div class="mt-4">
                        <img id="imagePreview" class="hidden w-full rounded-lg shadow-md">
                    </div>
                </div>

                <!-- Form Section -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">
                        Create a Post
                    </h3>

                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Post Content -->
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Write something...
                            </label>
                            <textarea class="w-full p-3 border rounded-lg dark:bg-gray-900 dark:text-white focus:ring focus:ring-blue-300"
                                      id="content" name="content" rows="3" placeholder="What's on your mind?"
                                      oninput="updatePreview()"></textarea>
                        </div>

                        <!-- Upload Image -->
                        <div class="mb-4">
                            <label for="media" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Upload Image
                            </label>
                            <input type="file" id="media" name="media"
                                   class="w-full p-2 border rounded-lg dark:bg-gray-900 dark:text-white"
                                   accept="image/*"
                                   onchange="previewImage(event)">
                        </div>

                        <!-- Post Type Selection -->
                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Post Type
                            </label>
                            <select id="type" name="type"
                                    class="w-full p-2 border rounded-lg dark:bg-gray-900 dark:text-white">
                                <option value="text">Text</option>
                                <option value="image">Image</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-red-600 text-white font-bold py-2 rounded-lg shadow-lg hover:bg-red-700 transition mt-4 border-2 border-black">
    🚀 Post
</button>




                    </form>
                </div>

            </div> <!-- End Grid -->
        </div>
    </div>

    <!-- Live Preview Script -->
    <script>
        function updatePreview() {
            document.getElementById("textPreview").innerText = document.getElementById("content").value || "Your text will appear here...";
        }

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const imgElement = document.getElementById("imagePreview");
                imgElement.src = reader.result;
                imgElement.classList.remove("hidden");
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

</x-app-layout>
