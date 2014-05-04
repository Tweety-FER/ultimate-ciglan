l = {
    t: [
        [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],
        [1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1],
        [1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1],
        [1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1],
        [1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1],
        [1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1],
        [1,0,0,0,0,0,0,0,0,0,8,0,0,0,0,0,0,0,0,0,0,0,0,1],
        [1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1],
        [1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1],
        [1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1],
        [1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1],
        [1,0,0,0,0,0,0,10,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1],
        [1,0,0,0,4,0,9,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1],
        [1,13,0,0,5,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1],
        [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1]
    ]
}

Game = {
    // This defines our grid's size and the size of each of its tiles
    grid: {
        w: 24,
        h: 15,
        t: {
            w: 16,
            h: 16
        }
    },

    level: {
        t: [],
        player: undefined
    },

    levelLoad: function(){
        Game.level.t = l.t;
        for(var y in Game.level.t){
            for(var x in Game.level.t[y]){
                //blank = 0, brick = 1, brickMoss = 2, grass = 3, door = 4, key = 5, stone = 6, stoneMoss = 7, stoneBreak = 8, spikeUp = 9, spikeLeft = 10, spikeDown = 11, spikeRight = 12, player = 13
                switch(Game.level.t[y][x]){
                    case 0:
                        break;
                    case 1:
                        Crafty.e("Brick").at(x,y);
                        break;
                    case 2:
                        Crafty.e("BrickMoss").at(x,y);
                        break;
                    case 3:
                        Crafty.e("Grass").at(x,y);
                        break;
                    case 4:
                        Crafty.e("Door").at(x,y);
                        break;
                    case 5:
                        Crafty.e("Key").at(x,y);
                        break;
                    case 6:
                        Crafty.e("Stone").at(x,y);
                        break;
                    case 7:
                        Crafty.e("StoneMoss").at(x,y);
                        break;
                    case 8:
                        Crafty.e("StoneBreak").at(x,y);
                        break;
                    case 9:
                        Crafty.e("Spike").rot("up").at(x,y);
                        break;
                    case 10:
                        Crafty.e("Spike").rot("left").at(x,y);
                        break;
                    case 11:
                        Crafty.e("Spike").rot("down").at(x,y);
                        break;
                    case 12:
                        Crafty.e("Spike").rot("right").at(x,y);
                        break;
                    case 13:
                        Game.level.player = Crafty.e("Player").at(x,y);
                        break;
                }

            }
        }
    },
    // The total width of the game screen. Since our grid takes up the entire screen
    // this is just the width of a tile times the width of the grid
    width: function() {
        return this.grid.w * this.grid.t.w;
    },

    // The total height of the game screen. Since our grid takes up the entire screen
    // this is just the height of a tile times the height of the grid
    height: function() {
        return this.grid.h * this.grid.t.h;
    },

    // Initialize and start our game
    start: function() {

        Crafty.init(Game.width(), Game.height());
        Crafty.background('rgb(128, 188, 234)');

        Crafty.sprite()
        Crafty.scene("loading", function() {
            Crafty.load(['img/spritesheet.png','img/tileset.png'], function() {
                Crafty.sprite(16,'img/spritesheet.png',{
                    spr_player: [0,0]
                },0,0);
                Crafty.sprite(16,'img/tileset.png',{
                    spr_blank: [0,0],
                    spr_brick: [1,0],
                    spr_brickMoss: [2,0],
                    spr_grass: [3,0],
                    spr_door: [0,1],
                    spr_doorLocked: [1,1],
                    spr_key: [2,1],
                    spr_stone: [3,1],
                    spr_stoneMoss: [0,2],
                    spr_stoneBreak: [1,2],
                    spr_spikeUp: [0,3],
                    spr_spikeRight: [1,3],
                    spr_spikeDown: [2,3],
                    spr_spikeLeft: [3,3]
                });
                Crafty.scene("main"); //when everything is loaded, run the main scene
            },
            function(e) {
                //progress
            },

            function(e) {
                //uh oh, error loading
                console.out("Error loading images");
            });

        });
        Crafty.scene("loading");

        Crafty.scene("main", function(){
            Game.levelLoad();
            Game.level.player.moving(2);
        });
    }
};