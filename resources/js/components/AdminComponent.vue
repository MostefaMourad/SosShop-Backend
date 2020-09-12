<template>
  <v-app id="inspire">
    <v-container fluid>
     <sidebar></sidebar>
    <v-main>
      <v-container
        class="fill-height"
        fluid
      >
        <v-layout justify-center>
            <v-flex shrink>
                <router-view> </router-view>
            </v-flex>
        </v-layout>
      </v-container>
    </v-main>

    <v-footer app dark>
        <v-col align-self="center">
            <span>&copy; Sos Shop Dashboard - {{ new Date().getFullYear() }} </span>
        </v-col>
    </v-footer> 
    </v-container>
  </v-app>
</template>

<script>
import Sidebar from "./_sidebar";


  export default {
    components: { Sidebar},  
    data: () => ({
      drawer: null,
      auth:false,
    }),
    created () {
      this.$vuetify.theme.dark = true
    },
  }
</script>