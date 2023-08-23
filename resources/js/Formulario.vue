<template>
    <v-app>
        <v-app-bar app extended>
            <img src="../images/logoMP.png" style="background-size: contain;height: 80px;padding:20px 1px 1px 20px;"/>
            <v-toolbar-title>Denuncias penales en Mendoza</v-toolbar-title>
            <v-spacer></v-spacer>
        </v-app-bar>
        <v-main>
            <v-container>

            </v-container>
        </v-main>
    </v-app>
</template>
<script setup>
import { ref } from 'vue';
const tarjetas = ref([
    {
        texto: 'Violencia 4',
        img: new URL('../images/4.jpg', import.meta.url).href
    },
    {
        imagen: '',
        texto: 'Violencia 3',
        img: new URL('../images/3.jpg', import.meta.url).href
    },
    {
        texto: 'Violencia 1',
        img: new URL('../images/1.jpg', import.meta.url).href
    },
    {
        imagen: '',
        texto: 'Violencia 2',
        img: new URL('../images/2.jpg', import.meta.url).href
    },
    {
        imagen: '',
        texto: 'Violencia 2',
        img: new URL('../images/5.jpg', import.meta.url).href
    },

]);
const imageBar = ref(new URL('../images/uno.png', import.meta.url).href)
</script>
<style >
.v-main__wrap {
    background-color: var(--v-fondo-base);
}
header {
    max-height: 85px;
}
</style>
