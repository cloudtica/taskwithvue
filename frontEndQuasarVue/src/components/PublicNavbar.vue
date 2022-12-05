<template>
        <q-toolbar class="navbar-style">
        <div class="row full-width hidesmall">
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" style="padding-top:10px;">
                <img  src="sitelogo.png" class="logomain"/>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 navbarlinkspaddingtop">
          
                    <q-btn to="/contact" style="text-transform:capitalize" class="contact-usbtn-style navbarlinks right">Contact Us</q-btn>
                    <q-btn to="/faqs" style="text-transform:capitalize" flat  class="greytext navbarlinks navbar-link-padding right" label="FAQ" />
                    <q-btn to="/examples" style="text-transform:capitalize" flat  class="greytext navbarlinks navbar-link-padding right" label="Case Studies" />
                    <q-btn to="/getinvolved" style="text-transform:capitalize" flat  class="greytext navbarlinks navbar-link-padding right" label="Map" />
                    <q-btn to="/fossilfreezones" style="text-transform:capitalize" flat  class="greytext navbarlinks navbar-link-padding right" label="Fossil Free Zones" />
                    <q-btn to="/about" style="text-transform:capitalize" flat  class="greytext navbarlinks navbar-link-padding right" label="About Us" />
                    <q-btn to="/" style="text-transform:capitalize" flat  class="navbarlinks greytext navbar-link-padding right" label="Home"  />
                    

            </div>
        </div>


        <div class="row full-width hidebig">
            <div class="col-xs-8 col-sm-8 col-md-10 col-lg-10">
                <img  src="logo.png" class="logomain"/>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-2 col-lg-2 paddingtopsmallmenu">
          
                <q-btn-dropdown class="mob-meny right" label="Menu">
                    <q-list>
                        <br/>
                        <q-btn style="text-transform:capitalize" to="/" flat  class="greytext mob-link  " label="Home" /><br/><br/>
                        <q-btn style="text-transform:capitalize" to="/about" flat  class=" greytext mob-link" label="About Us" /><br/><br/>
                        <q-btn style="text-transform:capitalize" to="/fossilfreezones" flat  class="greytext mob-link " label="Fossil Free Zones" /><br/><br/>
                        <q-btn style="text-transform:capitalize" to="/getinvolved" flat  class="greytext mob-link " label="Map" /><br/><br/>
                        <q-btn style="text-transform:capitalize" to="/examples" flat  class="greytext mob-link " label="Case Studies" /><br/><br/>
                        <q-btn style="text-transform:capitalize" to="/faqs" flat  class="greytext mob-link " label="FAQ" /><br/><br/>
                        <q-btn style="text-transform:capitalize" to="/contact" flat  class="greytext mob-link  " label="Contact Us" /><br/><br/>
                    </q-list>
                </q-btn-dropdown>

            </div>
        </div>
    

        </q-toolbar>
</template>


<script lang="ts">
import { defineComponent} from 'vue';


export default defineComponent({
name: 'FossilFreeZonesNavbar',

});
</script>
