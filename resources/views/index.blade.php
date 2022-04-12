<x-guest-layout>
    @include("partials.navigation")

    <main>
        @include("partials.hero")
        @include("partials.about")
        @include("partials.display")
        @include("partials.team")
        @include("partials.projects")
    </main>

    @include("partials.footer")

    @include("partials.auth")
    @include("partials.back-to-top")

</x-guest-layout>
