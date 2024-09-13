<div x-data="{
    theme: null,
    init: function() {
        this.theme = localStorage.getItem('theme') || 'dark'
        this.changeTheme(this.theme)
    },
    changeTheme: function(theme) {
        this.theme = theme
        localStorage.setItem('theme', theme)
        document.documentElement.className = theme
    }
}">
    <main class="wrapper w-full md:max-w-5xl mx-auto pt-20 px-4">
        <header class="flex justify-between">
            <div>
                <h1 class="text-xl font-medium text-gray-950 dark:text-white">Properties attributes</h1>
            </div>
            <a type="button" href="{{ route('properties') }}"
                class="ms:left-2 h-12  ms-10 block text-white bg-teal-500 hover:bg-teal-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Properties </a>

        </header>
        <section class="pt-4">
            {{ $this->table }}
        </section>
    </main>
</div>
