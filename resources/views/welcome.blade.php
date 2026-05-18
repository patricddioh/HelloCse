@include('header')


    <div class="container mt-5 mb-5">
        <div class="row">
           
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                <nav class="flex items-center justify-end gap-4">
                        <a
                            href="{{ route('produits.index') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                            >
                            Produits
                        </a>
                        <a
                            href="{{ route('categories.index') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                            >
                            Catégories
                        </a>
                </nav>
                </div>
                </div>
            </div>
        </div>
    </div>

@include('footer')