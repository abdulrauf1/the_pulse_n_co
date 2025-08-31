<x-public-layout>
    <!-- Hero Section -->
    <section class="relative bg-gray-100 dark:bg-gray-800 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white sm:text-5xl sm:tracking-tight lg:text-6xl">
                Our Story
            </h1>
            <p class="mt-3 max-w-md mx-auto text-base text-gray-500 dark:text-gray-300 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                Crafting timeless pieces since 2010
            </p>
        </div>
    </section>

    <!-- About Content -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:flex lg:items-center lg:space-x-12">
                <div class="lg:w-1/2 mb-8 lg:mb-0">
                    <div class="rounded-xl overflow-hidden shadow-lg">
                        <img src="https://images.unsplash.com/photo-1605106702734-205df224ecce?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                             alt="Our workshop" 
                             class="w-full h-auto object-cover">
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">The Pulse & Co Legacy</h2>
                    <div class="prose dark:prose-invert max-w-none">
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            Founded in 2010, The Pulse & Co began as a small workshop in Geneva, Switzerland, with a passion for creating timepieces that blend precision engineering with artistic craftsmanship.
                        </p>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            Our master watchmakers combine traditional techniques with modern innovation to produce watches that stand the test of time. Each piece is meticulously assembled by hand, ensuring the highest quality standards.
                        </p>
                        <p class="text-gray-600 dark:text-gray-300 mb-6">
                            Today, we're proud to serve customers worldwide while maintaining our commitment to excellence and attention to detail that has defined our brand from the beginning.
                        </p>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mt-8">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-blue-800 dark:text-blue-500">12+</div>
                                <div class="text-gray-600 dark:text-gray-400 mt-2">Years in Business</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-blue-800 dark:text-blue-500">50K+</div>
                                <div class="text-gray-600 dark:text-gray-400 mt-2">Happy Customers</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-blue-800 dark:text-blue-500">24</div>
                                <div class="text-gray-600 dark:text-gray-400 mt-2">Master Craftsmen</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team -->
    <section class="py-12 bg-gray-50 dark:bg-gray-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Meet Our Master Watchmakers</h2>
                <p class="mt-2 text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    The talented individuals behind our precision timepieces
                </p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach([
                    ['name' => 'Jean-Luc Dubois', 'role' => 'Founder & Lead Watchmaker', 'image' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1887&q=80'],
                    ['name' => 'Sophie Moreau', 'role' => 'Movement Specialist', 'image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1888&q=80'],
                    ['name' => 'Marco Bianchi', 'role' => 'Case & Dial Engineer', 'image' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1887&q=80'],
                    ['name' => 'Elise Richter', 'role' => 'Quality Control', 'image' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1961&q=80']
                ] as $member)
                <div class="text-center">
                    <div class="rounded-full h-40 w-40 mx-auto overflow-hidden shadow-md mb-4">
                        <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}" class="h-full w-full object-cover">
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $member['name'] }}</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ $member['role'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</x-public-layout>