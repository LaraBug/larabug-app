import Prism from '../plugins/prism';
import anime from 'animejs/lib/anime.es.js';

(function() {
    Prism.highlightAll();

    const shareTimeline = anime.timeline({
        easing: 'easeOutBack',
        duration: 500,
        delay: 250,
        loop: true,
    });

    shareTimeline
        .add({
            targets: '.animation-share-card',
            translateY: [64, 0],
            opacity: [0, 1],
            delay: anime.stagger(100),
            endDelay: 400,
        })
        .add({
            targets: '.animation-share-button',
            scale: [1, .9, 1],
        })
        .add({
            targets: '.animation-share-card',
            translateY: [0, -64],
            opacity: [1, 0],
            delay: anime.stagger(100)
        })
        .add({
            targets: '.animation-share-modal',
            scale: [0, 1],
            opacity: [0, 1],
        }, '-=500')
        .add({
            targets: '.animation-share-modal .animation-stagger',
            translateY: [64, 0],
            opacity: [0, 1],
            delay: anime.stagger(100),
            endDelay: 4000,
        })
        .add({
            targets: '.animation-share-modal',
            scale: [1, 2],
            opacity: [1, 0],
        });

    const feedbackTimeline = anime.timeline({
        easing: 'easeOutBack',
        duration: 500,
        delay: 250,
        loop: true,
    });

    feedbackTimeline
        .add({
            targets: '.animation-feedback-button',
            scale: [1, .9, 1],
        })
        .add({
            targets: '.animation-feedback-modal',
            scale: [0, 1],
            opacity: [0, 1],
        })
        .add({
            targets: '.animation-feedback-modal .animation-stagger',
            translateY: [64, 0],
            opacity: [0, 1],
            delay: anime.stagger(100),
            endDelay: 4000,
        })
        .add({
            targets: '.animation-feedback-modal-button',
            scale: [1, .9, 1],
        })
        .add({
            targets: '.animation-feedback-modal',
            scale: [1, 2],
            opacity: [1, 0],
        });
})();