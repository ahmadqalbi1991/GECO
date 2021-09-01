@extends('site.main')

@section('content')

    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area breadcrumb-bg third-breadcrumb-bg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <h2>Blog <span>Details</span></h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Blog Details</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->

        <!-- blog-area -->
        <section class="blog-area primary-bg pt-120 pb-175">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blog-list-post blog-details-wrap">
                            <div class="blog-list-post-content">
                                <h2>Epic Disables Disrespectful Fortnite Emotes In The Martin Luther King Event</h2>
                                <div class="blog-meta">
                                    <ul>
                                        <li>28 August, 2021</li>
                                    </ul>
                                </div>
                                <p>I know, I know. The last thing the world seems to need right now is yet another Marvel video game. It feels as if a
                                    dozen have been announced and about as many have been released in the last few years. On top of that, this is a
                                    mobile game, so I know a lot of you have already checked out. But listen to me. I think Marvel Future Revolution
                                    is a fun open-world MMORPG that’s bursting with wild comic-book energy and isn’t nearly as annoying to play as
                                    Marvel’s Avengers.

                                    The first thing that impressed me about Marvel Future Revolution was the roster of characters it launched with.
                                    You get your usual Iron Man and Captain America, but it also includes Storm, Captain Marvel, and Dr. Strange,
                                    heroes who don’t show up in games as often as some other, more widely used Marvel characters. Future Revolution
                                    also launched this week on iOS and Android with Spider-Man, a character who still hasn’t appeared in Square Enix’s
                                    Avengers game. Rounding out the initial roster is Star-Lord, who, like other characters on offer here, is heavily
                                    inspired by his MCU counterpart.

                                    Marvel Future Revolution’s story isn’t especially original, focusing on other dimensions and alternate Earths
                                    colliding into each other, causing different versions of heroes and villains to meet face to face with their
                                    superpowered doppelgängers. If you’ve read any Marvel comics or played any superhero games in the last decade or
                                    so, you’ve probably already encountered this kind of setup. But while it’s not a unique story, it helps explain
                                    why 200 Spider-Men are running around the same area.

                                    Developed by Netmarble, Marvel Future Revolution is marketed as the first Marvel-themed open-world action RPG.
                                    This is technically true, but it ignores that Future Revolution is also an MMO in many ways. It almost seems like
                                    Marvel wants us all to forget that the game Marvel Heroes existed. Like Marvel Heroes, you pick a hero and level
                                    them up by running around various worlds filled with other players, beating up bad guys and collecting loot.
                                    However, Future Revolution also includes many side quests and loot that actually changes how your hero looks, not
                                    just their stats. This means you can end up with some very ugly superheroes early on as you grab and equip any
                                    new, better gear you acquire.</p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="blog-details-img">
                                            <img src="{{ asset('site/img/blog/1.jpg') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="blog-img">
                            <img src="{{ asset('site/img/blog/2.jpg') }}" alt="" style="width: 100%">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- blog-area-end -->

    </main>
@endsection
