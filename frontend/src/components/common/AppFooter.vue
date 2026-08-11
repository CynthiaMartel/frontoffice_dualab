<template>
  <footer class="bg-[#1F2937] text-white/60 py-8 px-6 border-t border-white/10">
    <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">

      <!-- Logo — mismo tratamiento que navbar -->
      <RouterLink :to="{ name: 'home' }" class="flex items-center group">
        <img
          src="@/assets/logo.png"
          alt="Logo DuaLab"
          class="h-9 object-contain relative z-10 -mr-2.5 transition-transform duration-300 group-hover:scale-105"
        />
        <span class="font-black tracking-tighter uppercase leading-none relative z-20 flex items-baseline gap-0">
          <span class="text-white text-[22px]">Dua</span><span class="text-[#00A859] text-[22px]">Lab</span>
        </span>
      </RouterLink>

      <p class="text-sm text-white/40">© {{ year }} DuaLab. Todos los derechos reservados.</p>

    </div>
  </footer>
</template>

<script setup>
const year = new Date().getFullYear()
</script>
