import './bootstrap';

import '../css/app.css';

import Alpine from 'alpinejs';

import AOS from 'aos';
import 'aos/dist/aos.css';

import { gsap } from "gsap";

import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

document.addEventListener("DOMContentLoaded", () => {
    gsap.from(".hero-text", {
        duration: 1.5,
        y: 100,
        opacity: 0,
        ease: "power4.out"
    });
});

AOS.init();


window.Alpine = Alpine;

Alpine.start();





