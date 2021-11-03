<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   @include('store.components.head')
   <body>
      @include('store.components.header')
      @if(Auth::check())
         @include('store.components.rightBar')
      @endif
         @yield('pagesStore')
      @include('store.components.modal')
      @include('store.components.script')
   </body>
</html>
