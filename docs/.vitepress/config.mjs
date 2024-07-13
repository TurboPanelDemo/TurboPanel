import { defineConfig } from 'vitepress'
import { version } from '../package.json';

// https://vitepress.dev/reference/site-config
export default defineConfig({

  locales: {
    root: {
      label: 'English',
      lang: 'en'
    },
    // bg: {
    //   label: 'Български',
    //   lang: 'bg',
    // }
  },
  base: 'https://turbopanel.github.io/TurboPanel/',
  
  sitemap: {
    hostname: 'https://turbopanel.github.io/TurboPanel/',
    lastmodDateOnly: false
  },

  lang: 'en-US',
  title: "Turbo Panel",
  description: "Turbo Panel - Documentation",
  themeConfig: {

    search: {
      provider: 'local'
    },

    logo: '/turbo-logo-icon.svg',
    // https://vitepress.dev/reference/default-theme-config
    nav: [
      { text: 'Home', link: '/' },
      { text: 'Install', link: '/install' },
      { text: 'Introduction', link: '/introduction/getting-started' },
      { text: 'Team', link: '/team' },

      {
        text: `v${version}`,
        items: [
          {
            text: 'Changelog',
            link: 'https://github.com/TurboPanelDemo/TurboPanel/blob/main/CHANGELOG.md',
          },
          {
            text: 'Contributing',
            link: 'https://github.com/TurboPanelDemo/TurboPanel/blob/main/CONTRIBUTING.md',
          },
          {
            text: 'Security policy',
            link: 'https://github.com/TurboPanelDemo/TurboPanel/blob/main/SECURITY.md',
          },
        ],
      },
    ],

    sidebar: [
      {
        text: 'Introduction',
        items: [
          { text: 'Getting Started', link: '/introduction/getting-started' },
          { text: 'Installation', link: '/install' },
          { text: 'Requirements', link: '/introduction/requirements' },
          { text: 'Features', link: '/introduction/features' },
        ]
      },
      {
        text: 'Integrations',
        items: [
          { text: 'WHMCS', link: '/integrations/whmcs' },
        ]
      },
      {
        text: 'Contributing',
        items: [
          { text: 'Documentation', link: '/contributing/documentation' },
        ]
      }
    ],

    socialLinks: [
      { icon: 'github', link: 'https://github.com/TurboPanelDemo/TurboPanel' }
    ],

    footer: {
      message: 'Released under the GNU License.',
      copyright: 'Copyright © 2024-present Turbo Control Panel',
    },


  }
})
