import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

import Acheteur from './../pages/Acheteur'
import Categorie from './../pages/Categorie'
import Commande from './../pages/Commande'
import Contact from './../pages/Contact'
import Faq from './../pages/Faq'
import Livraison from './../pages/Livraison'
import Produit from './../pages/Produit'
import Publicite from './../pages/Publicite'
import Service from './../pages/Service'
import SousCategorie from './../pages/SousCategorie'
import Vendeur from './../pages/Vendeur'

const routes = [
    {
        path:'/admin/acheteur',
        component:Acheteur
    },
    {
        path:'/admin/categorie',
        component:Categorie
    },
    {
        path:'/admin/commande',
        component:Commande
    },
    {
        path:'/admin/contact',
        component:Contact
    },
    {
        path:'/admin/faq',
        component:Faq
    },
    {
        path:'/admin/livraison',
        component:Livraison
    },
    {
        path:'/admin/produit',
        component:Produit
    },
    {
        path:'/admin/publicite',
        component:Publicite
    },
    {
        path:'/admin/service',
        component:Service
    },
    {
        path:'/admin/souscategorie',
        component:SousCategorie
    },
    {
        path:'/admin/vendeur',
        component:Vendeur
    },
]

export default new Router({
    mode:'hash',
    routes,
  });