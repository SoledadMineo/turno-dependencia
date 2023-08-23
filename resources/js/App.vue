<template>
    <v-app>
        <v-app-bar app extended>
            <img src="../images/logoMP.png" style="background-size: contain;height: 80px;padding:20px 1px 1px 20px;"/>
            <v-toolbar-title>Denuncias penales en Mendoza</v-toolbar-title>
            <v-spacer></v-spacer>
        </v-app-bar>
        <v-main>
            <v-container>
                <v-row>
                    <v-col v-for="(tarjeta, index) in tarjetas" :key="index" cols="12" md="6" lg="4" style="cursor:pointer">
                        <v-card elevation="10" @click="redirectTarjeta(tarjeta)">
                            <v-img
                                class="align-end text-white"
                                height="25vh"
                                :src="tarjeta.img"
                                cover/>
                            <v-card-title>
                                {{ tarjeta.texto }}
                            </v-card-title>
                            <v-card-subtitle>
                                {{ tarjeta.texto }}
                            </v-card-subtitle>
                            <v-card-actions>
                                <v-list-item class="w-100">
                                    <template v-slot:append>
                                        <div class="justify-self-end">
                                            <v-icon>mdi-share-variant</v-icon>
                                        </div>

                                    </template>

                                </v-list-item>

                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>
<script setup>
import { ref } from 'vue';
const redirectTarjeta= (tarjeta) => {
    return window.location = new URL('denuncia/' + tarjeta.slug, document.head.baseURI);
};
const tarjetas = ref([
    {
        slug: 'cuatro',
        texto: 'Violencia 4',
        img: new URL('../images/4.jpg', import.meta.url).href
    },
    {
        slug: 'tres',
        texto: 'Violencia 3',
        img: new URL('../images/3.jpg', import.meta.url).href
    },
    {
        slug: 'uno',
        texto: 'Violencia 1',
        img: new URL('../images/1.jpg', import.meta.url).href
    },
    {
        slug: 'dos',
        texto: 'Violencia 2',
        img: new URL('../images/2.jpg', import.meta.url).href
    },
    {
        slug: 'uno',
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
