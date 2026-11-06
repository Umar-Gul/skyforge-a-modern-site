<?php

/*
|--------------------------------------------------------------------------
| Skyforge content + image sources
|--------------------------------------------------------------------------
| All photos are hosted on Unsplash (free to use under the Unsplash License).
| To swap an image, replace the photo id inside $u('...') or paste any full URL.
| Views append ?auto=format&fit=crop&w=...&q=... themselves.
*/

$u = fn (string $id) => "https://images.unsplash.com/photo-{$id}";

// Mixkit stock clips (free licence, no watermark). The browser tries 720p first, then 360p.
// To use your own file instead, put it in public/videos and use: ['/videos/my-clip.mp4']
$v = fn (int $id) => ["https://assets.mixkit.co/videos/{$id}/{$id}-720.mp4", "https://assets.mixkit.co/videos/{$id}/{$id}-360.mp4"];

return [

    // Hero slider: one entry per slide. "label" is the small tab under the slider.
    'hero_slides' => [
        [
            'label'   => 'Skyforge',
            'eyebrow' => 'Skyforge Aviation',
            'title'   => "Engineered\nto rise.",
            'text'    => 'Next-generation aircraft built for the missions that move the world forward.',
            'cta'     => ['Explore Aircraft', 'aircraft.index'],
            'image'   => $u('1687222947839-3b285f63f87d'), // Jordy Muñoz
            'video'   => $v(6952),  // helicopter flying in the sky
        ],
        [
            'label'   => 'Vanguard',
            'eyebrow' => 'SF-200 Vanguard',
            'title'   => "Vertical lift.\nNo limits.",
            'text'    => 'A tiltrotor that takes off like a helicopter and cruises like an aircraft.',
            'cta'     => ['Discover the Vanguard', 'aircraft.show', 'sf-200-vanguard'],
            'image'   => $u('1629032642277-a112ec9fe93b'), // Joel Rivera-Camacho
            'video'   => $v(11965), // military aircraft taking off
        ],
        [
            'label'   => 'Horizon',
            'eyebrow' => 'SF-450 Horizon',
            'title'   => "Regional flight,\nreimagined.",
            'text'    => 'Hybrid-electric power that cuts noise, cost and emissions on every short-haul route.',
            'cta'     => ['Discover the Horizon', 'aircraft.show', 'sf-450-horizon'],
            'image'   => $u('1651444335570-b96706acda0a'), // Byron Breytenbach
            'video'   => $v(11900), // aircraft at the coast
        ],
        [
            'label'   => 'Guardian',
            'eyebrow' => 'SF-120 Guardian',
            'title'   => "When every\nminute counts.",
            'text'    => 'Rescue and medical rotorcraft that reach the places other aircraft cannot.',
            'cta'     => ['Discover the Guardian', 'aircraft.show', 'sf-120-guardian'],
            'image'   => $u('1759412003138-6ecf7c76c539'), // Asher Pardey
            'video'   => $v(24596), // rescue helicopter in action
        ],
    ],

    'aircraft' => [
        [
            'slug'  => 'sf-200-vanguard',
            'name'  => 'SF-200 Vanguard',
            'type'  => 'Vertical-lift tiltrotor',
            'image' => $u('1519074031893-210d39bd3885'),
            'specs' => [['Range', '900 km'], ['Speed', '510 km/h'], ['Payload', '2,400 kg']],
        ],
        [
            'slug'  => 'sf-450-horizon',
            'name'  => 'SF-450 Horizon',
            'type'  => 'Regional hybrid-electric',
            'image' => $u('1676335786580-f23146c2ed09'), // Cook aynne
            'specs' => [['Range', '1,600 km'], ['Speed', '420 km/h'], ['Seats', '19']],
        ],
        [
            'slug'  => 'sf-90-falcon',
            'name'  => 'SF-90 Falcon',
            'type'  => 'Autonomous cargo drone',
            'image' => $u('1488263590619-bc1fff43b6c1'),
            'specs' => [['Range', '300 km'], ['Speed', '160 km/h'], ['Payload', '90 kg']],
        ],
        [
            'slug'  => 'sf-120-guardian',
            'name'  => 'SF-120 Guardian',
            'type'  => 'Emergency response rotorcraft',
            'image' => $u('1531570003789-62d56ed3b271'), // Neil Thomas
            'specs' => [['Range', '650 km'], ['Speed', '280 km/h'], ['Crew', '2 + 6']],
        ],
    ],

    // Pinned "Solutions" section (Phase 3)
    'solutions' => [
        [
            'title' => 'Defense',
            'text'  => 'Mission-ready platforms with the range, survivability and autonomy that modern operations demand.',
            'image' => $u('1766514937921-da8aa3e189fe'),
        ],
        [
            'title' => 'Commercial',
            'text'  => 'Efficient, quiet and dependable aircraft that open new routes and lower operating costs.',
            'image' => $u('1495554698253-681539e9ea84'),
        ],
        [
            'title' => 'Emergency Response',
            'text'  => 'Rapid-access rotorcraft built for rescue, medical transport and disaster relief.',
            'image' => $u('1629205163875-8f3d9a17e09e'),
        ],
        [
            'title' => 'Training & Support',
            'text'  => 'Global lifecycle support, simulators and pilot training that keep every aircraft mission-ready.',
            'image' => $u('1770988966461-5dfb033f8e5f'),
        ],
    ],

    // Newsroom (Phase 4). First entry is the large featured story. All stories are fictional.
    'news' => [
        [
            'slug'     => 'vanguard-completes-transition-flight',
            'tag'      => 'Flight test',
            'category' => 'military',
            'date'     => 'Oct 28, 2026',
            'title'    => 'Vanguard completes first full transition flight',
            'excerpt'  => 'The SF-200 tiltrotor lifted off vertically, converted to wing-borne flight and landed again, a key milestone on the road to certification.',
            'image'    => $u('1629032642277-a112ec9fe93b'),
            'body'     => [
                'The Skyforge SF-200 Vanguard has completed its first full transition flight, lifting off vertically, tilting its rotors forward to cruise on its wing, and returning to a vertical landing in a single sortie.',
                'The flight lasted 42 minutes and validated the flight-control laws that blend rotor and wing lift during conversion. Test pilots reported stable handling throughout the corridor, with no manual intervention needed during the transition.',
                'The result clears the way for the next phase of the flight-test campaign, which will expand the speed envelope and begin hot-and-high operations ahead of certification.',
            ],
        ],
        [
            'slug'     => 'horizon-passes-range-target',
            'tag'      => 'Innovation',
            'category' => 'innovation',
            'date'     => 'Oct 14, 2026',
            'title'    => 'Horizon hybrid-electric passes 1,600 km range target',
            'excerpt'  => 'A demonstrator flew the full design range on a mix of electric and turbine power, with fuel burn well below conventional regional aircraft.',
            'image'    => $u('1676335786580-f23146c2ed09'),
            'body'     => [
                'The SF-450 Horizon demonstrator has flown its full 1,600 km design range, combining electric power for takeoff and climb with a compact turbine generator for cruise.',
                'Engineers measured fuel burn well below that of comparable turboprops on the same route, along with a clear drop in cabin and community noise on departure.',
                'The team will now repeat the profile with sustainable aviation fuel to quantify the additional lifecycle savings.',
            ],
        ],
        [
            'slug'     => 'guardian-joins-air-ambulance-network',
            'tag'      => 'Service',
            'category' => 'commercial',
            'date'     => 'Sep 30, 2026',
            'title'    => 'Guardian joins regional air ambulance network',
            'excerpt'  => 'The first SF-120 Guardian enters service, cutting response times to remote communities.',
            'image'    => $u('1531570003789-62d56ed3b271'),
            'body'     => [
                'A regional air ambulance operator has taken delivery of the first SF-120 Guardian, adding a twin-engine rescue rotorcraft built around the first hour after an emergency.',
                'Its compact rotor allows landings on rooftops, roadways and clearings that larger helicopters cannot use, and the flat-floor cabin takes a full critical-care team.',
                'The operator expects average response times to remote communities to fall as the aircraft joins its night-capable fleet.',
            ],
        ],
        [
            'slug'     => 'falcon-begins-resupply-trials',
            'tag'      => 'Autonomy',
            'category' => 'military',
            'date'     => 'Sep 12, 2026',
            'title'    => 'Falcon begins autonomous resupply trials',
            'excerpt'  => 'The SF-90 cargo drone started a month-long trial moving supplies between forward sites with one operator supervising several aircraft.',
            'image'    => $u('1488263590619-bc1fff43b6c1'),
            'body'     => [
                'Skyforge has started a month-long resupply trial of the SF-90 Falcon, moving cargo pods between forward sites with a single operator supervising several aircraft at once.',
                'The trial exercises detect-and-avoid, automatic return-home logic and the encrypted command-and-control link in realistic terrain and weather.',
                'Early results show the aircraft completing routes unaided and re-planning around weather without operator input.',
            ],
        ],
        [
            'slug'     => 'labs-composite-wing-breakthrough',
            'tag'      => 'Skyforge Labs',
            'category' => 'innovation',
            'date'     => 'Aug 20, 2026',
            'title'    => 'Skyforge Labs unveils lighter composite wing',
            'excerpt'  => 'A new automated layup process cuts wing weight and build time for the next generation of Skyforge aircraft.',
            'image'    => $u('1770988966461-5dfb033f8e5f'),
            'body'     => [
                'Skyforge Labs has unveiled a composite wing produced with a new automated layup process, trimming structural weight while shortening build time.',
                'Lower weight translates directly into range and payload, and the process is designed to be repeatable across the SF-450 and future platforms.',
                'The wing has passed its first static-load campaign and moves to fatigue testing next quarter.',
            ],
        ],
        [
            'slug'     => 'horizon-launch-routes-announced',
            'tag'      => 'Commercial',
            'category' => 'commercial',
            'date'     => 'Aug 4, 2026',
            'title'    => 'Launch routes announced for the SF-450 Horizon',
            'excerpt'  => 'Three regional carriers will introduce the Horizon on short-haul routes that conventional aircraft struggled to serve profitably.',
            'image'    => $u('1651444335570-b96706acda0a'),
            'body'     => [
                'Three regional carriers have confirmed the first routes for the SF-450 Horizon, focusing on short sectors where noise limits and operating cost have held back service.',
                'The nineteen-seat aircraft is designed for short-field operations, letting carriers reach smaller airfields without major infrastructure changes.',
                'Deliveries are planned to begin after certification, with route launches phased across the following year.',
            ],
        ],
        [
            'slug'     => 'training-academy-opens',
            'tag'      => 'Support',
            'category' => 'commercial',
            'date'     => 'Jul 21, 2026',
            'title'    => 'Skyforge Training Academy welcomes its first class',
            'excerpt'  => 'Pilots and maintainers begin type-rating courses on the new simulator suite.',
            'image'    => $u('1759412003138-6ecf7c76c539'),
            'body'     => [
                'The Skyforge Training Academy has opened its doors with a first class of pilots and maintainers working through type-rating courses on a new simulator suite.',
                'Courses combine full-motion simulation with hands-on technical training, and are open to operators of every Skyforge platform.',
                'Regional academies are planned to bring the same curriculum closer to customers worldwide.',
            ],
        ],
        [
            'slug'     => 'defense-lift-partnership',
            'tag'      => 'Defense',
            'category' => 'military',
            'date'     => 'Jul 2, 2026',
            'title'    => 'Skyforge signs vertical-lift partnership with industry team',
            'excerpt'  => 'A coalition of industrial partners will support Vanguard production and sustainment.',
            'image'    => $u('1766514937921-da8aa3e189fe'),
            'body'     => [
                'Skyforge has signed a partnership with a coalition of industrial suppliers to support Vanguard production and in-service sustainment.',
                'The agreement brings together expertise in propulsion, avionics and advanced manufacturing under a single delivery framework.',
                'Work begins immediately on the production readiness review.',
            ],
        ],
    ],

    // Background photo for the closing call-to-action band (Phase 4)
    'cta_image' => $u('1495554698253-681539e9ea84'),

    // Detail-page content for each aircraft, keyed by slug (Phase 5)
    'aircraft_details' => [
        'sf-200-vanguard' => [
            'summary'  => 'The Vanguard is a vertical-lift tiltrotor that takes off and lands like a helicopter, then tilts its rotors forward to cruise at the speed of a turboprop. It reaches austere sites without a runway and covers the distance between them in a fraction of the time.',
            'features' => ['Tilting rotors with fly-by-wire flight control', 'Cabin reconfigurable for cargo, troops or casualty evacuation', 'Folding wing and rotors for ship and hangar storage', 'Redundant digital avionics with degraded-visibility landing aids', 'Ballistic-tolerant structure and crashworthy seating'],
            'more'     => [['Ceiling', '7,600 m'], ['Crew', '2 + 12'], ['Engines', '2 turboshaft']],
        ],
        'sf-450-horizon' => [
            'summary'  => 'The Horizon is a nineteen-seat regional aircraft with a hybrid-electric powertrain. Electric motors handle takeoff and climb quietly, while a compact turbine generator extends range, cutting fuel burn and noise on short-haul routes that conventional aircraft struggle to serve profitably.',
            'features' => ['Hybrid-electric propulsion with distributed motors', 'Up to 30 percent lower operating cost on short routes', 'Short-field capability for regional airstrips', 'Quiet cabin with large windows and standing-height aisle', 'Ready for sustainable aviation fuel'],
            'more'     => [['Ceiling', '7,000 m'], ['Crew', '2'], ['Propulsion', 'Hybrid-electric']],
        ],
        'sf-90-falcon' => [
            'summary'  => 'The Falcon is an autonomous cargo drone built to move supplies where roads and runways are slow, unsafe or missing. It flies pre-planned or on-demand routes with a human supervisor monitoring a whole fleet from the ground.',
            'features' => ['Fully autonomous route planning and detect-and-avoid', 'Swappable cargo pods for medical, industrial and humanitarian loads', 'Operates from a standard shipping-container base', 'Encrypted command-and-control link with automatic return home', 'Low acoustic signature for operation near communities'],
            'more'     => [['Ceiling', '4,500 m'], ['Crew', 'Uncrewed'], ['Propulsion', 'Electric']],
        ],
        'sf-120-guardian' => [
            'summary'  => 'The Guardian is a twin-engine rescue rotorcraft designed around the first hour after an emergency. It carries a two-person crew and a full medical team, and its compact rotor lets it land on rooftops, roadways and in clearings that larger helicopters cannot use.',
            'features' => ['Twin engines with single-engine-out performance', 'Flat-floor cabin for stretchers and critical-care equipment', 'Rescue hoist and external load hook', 'Night-vision-compatible cockpit and searchlight', 'Rapid-response configuration change in under 20 minutes'],
            'more'     => [['Ceiling', '5,800 m'], ['Endurance', '3 h 30 min'], ['Engines', '2 turboshaft']],
        ],
    ],

];
