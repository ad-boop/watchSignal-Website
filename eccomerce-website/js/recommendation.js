"use strict";
// JAVASCRIPT FOR CUSTOMER TRACKING AND RECOMMENDATIONS


//Constructor for the recommender object
export class Recommendation {
    //Holds the keywords
    search_keywords = {};

    //search_keywords older than this window will be deleted
    timeWindow = 19000;

    constructor(){
        this.load();
    }

    //Adds a keyword to the reommender
    addKeyword(word){
        //Increase count of keyword
        if(this.search_keywords[word] === undefined)
            this.search_keywords[word] = {count: 1, date: new Date().getTime()};
        else{
            this.search_keywords[word].count++;
            this.search_keywords[word].date = new Date().getTime();
        }
        
        console.log(JSON.stringify(this.search_keywords));
        
        //Save state of Recommendation
        this.save();
    }

    //Returns the most popular keyword
    getPopularSearch(){
        //Clean up old search_keywords
        this.deleteOldKeywords();
        
        //Return word with highest count
        let maxCount = 0;
        let maxKeyword = "";
        for(let word in this.search_keywords){
            if(this.search_keywords[word].count > maxCount){
                maxCount = this.search_keywords[word].count;
                maxKeyword = word;
            }
        }
        return maxKeyword;
    }

    /* Saves state of Recommendation. Currently this uses local storage, 
        but it could easily be changed to save on the server */
    save(){
        localStorage.recommenderWords = JSON.stringify(this.search_keywords);
    };

    /* Loads state of recommender */
    load(){
        if(localStorage.recommenderWords === undefined)
            this.search_keywords = {};
        else
            this.search_keywords = JSON.parse(localStorage.recommenderWords);
        
        //Clean up keywords by deleting old ones
        this.deleteOldKeywords();
    };
    
    //Removes keywords that are older than the time window
    deleteOldKeywords(){
        let currentTimeMillis = new Date().getTime();
        for(let word in this.search_keywords){
            if(currentTimeMillis - this.search_keywords[word].date > this.timeWindow){
                delete this.search_keywords[word];
            }
        }
        this.save();
    }
}

