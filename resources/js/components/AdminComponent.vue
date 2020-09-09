<template>
  <v-app id="inspire">
     <sidebar></sidebar>
    <v-content>
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
    </v-content>

    <v-footer app color="#00adb5">
      <span>&copy;Tourathi Dashboard</span>
    </v-footer>
  </v-app>
</template>

<script>
import Sidebar from "./_sidebar";
import Navbar from "./_navbar";


  export default {
    components: { Sidebar, Navbar},  
    data: () => ({
      drawer: null,
      auth:false,
    }),
    created () {
      this.$vuetify.theme.dark = true
    },
  }
</script>